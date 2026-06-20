<?php
require_once('../header.php');


/* Banner */
$data = get_banners_image_info();
$img = "";
if ($data) {
    foreach ($data as $banner) {
        $img = '../admin/banners_image/image/' . $banner['health_package_image'];
    }
}

/* TOKEN */
$token = "e7e41fadbd451732530ef17ccfd63acd7106e074de0d43faa3f45e18f2116a41";

/* DOCTORS API */
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://cep.prodoc.ai/api/v1/appointment/branch-doctors");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer ".$token,
    "Content-Type: application/json"
]);
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);
$doctors = $result['data']['doctors'] ?? [];

/* Departments */
$departments = [];
foreach($doctors as $doc){
    $departments[$doc['department']['id']] = $doc['department']['name'];
}
?>

<section class="page-title" style="background-image:url('<?= $img ?>');">
    <div class="auto-container">
        <h1>Admission Enquiry</h1>
    </div>
</section>
<section class="auto-container"> 
  <nav class="breadcrumb" aria-label="Breadcrumb">
    <a href="/">Home</a>
    <span> › </span>
    <span class="current">Admission Enquiry</span>
 </nav>
</section>

<section class="checkout-page">
<div class="container mt-4">

<div id="msg"></div>

<form id="appointmentForm" class="p-4 shadow rounded bg-white">

    <h3 class="mb-4 text-success border-bottom pb-2">
        Admission Enquiry
    </h3>

    <div class="row">

        <!-- Department -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Department <span class="text-danger">*</span></label>
            <select id="department" class="form-control">
                <option value="">Choose Department</option>
                <?php foreach($departments as $id=>$name){ ?>
                    <option value="<?= $id ?>"><?= $name ?></option>
                <?php } ?>
            </select>
        </div>

        <!-- Doctor -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Doctor <span class="text-danger">*</span></label>
            <select name="appointment_with" id="appointment_with" class="form-control">
                <option value="">Choose Doctor</option>
            </select>
        </div>

        <!-- Name -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Patient Name <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter patient name" required>
        </div>

        <!-- Email -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" required>
        </div>

        <!-- Phone -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
            <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter mobile number" required>
        </div>

        <!-- Date -->
        <div class="col-md-6 mb-3">
            <label class="form-label">Appointment Date <span class="text-danger">*</span></label>
            <input type="date" id="appointment_date" name="appointment_date" class="form-control" required>
        </div>

        <!-- Slots -->
        <div class="col-md-12 mb-3">
            <label class="form-label">Select Time Slot <span class="text-danger">*</span></label>
            
            <div id="slots" class="d-flex flex-wrap gap-2 border p-2 rounded bg-light"></div>
            
            <input type="hidden" name="appointment_slot" id="appointment_slot">
        </div>

        <!-- Comments -->
        <div class="col-md-12 mb-3">
            <label class="form-label">Comments</label>
            <textarea name="comments" id="comments" class="form-control" rows="3" placeholder="Enter description"></textarea>
        </div>

        <!-- Submit -->
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary w-100 py-2">
                Book Appointment
            </button>
        </div>

    </div>

</form>

</div>
</section>

<script>

const token = "<?= $token ?>";
const doctors = <?= json_encode($doctors) ?>;

const deptInput = document.getElementById("department");
const doctorInput = document.getElementById("appointment_with");
const dateInput = document.getElementById("appointment_date");
const slotBox = document.getElementById("slots");

let selectedDoctor = "";
let allowedDays = [];

/* BLOCK PAST DATES */
dateInput.min = new Date().toISOString().split('T')[0];

/* =========================
   DATE FORMAT CONVERT
========================= */
function toDDMMYYYY(dateStr){
    let d = new Date(dateStr);
    let dd = String(d.getDate()).padStart(2,'0');
    let mm = String(d.getMonth()+1).padStart(2,'0');
    let yyyy = d.getFullYear();
    return `${dd}-${mm}-${yyyy}`;
}

/* =========================
   DEPARTMENT → DOCTOR
========================= */
deptInput.addEventListener("change", function(){

    let deptId = this.value;
    doctorInput.innerHTML = '<option value="">Select Doctor</option>';

    doctors.forEach(doc => {
        if(doc.department.id == deptId){
            doctorInput.innerHTML += `<option value="${doc.id}">${doc.name}</option>`;
        }
    });

});

/* =========================
   GET AVAILABLE DAYS
========================= */
doctorInput.addEventListener("change", function(){

    selectedDoctor = this.value;

    if(!selectedDoctor) return;

    fetch(`https://cep.prodoc.ai/api/v1/appointment/doctor-days?doctorId=${selectedDoctor}`,{
        headers:{
            "Authorization": "Bearer " + token
        }
    })
    .then(res => res.json())
    .then(res => {

        allowedDays = (res.data || []).map(d => d.toUpperCase());
    });

});

/* =========================
   DATE CHANGE
========================= */
dateInput.addEventListener("change", function(){

    let selectedDate = this.value;

    let day = new Date(selectedDate)
        .toLocaleDateString('en-US', { weekday: 'short' })
        .toUpperCase();

    if(!allowedDays.includes(day)){
        alert("Doctor not available on " + day);
        this.value = "";
        slotBox.innerHTML = "";
        return;
    }

    let apiDate = toDDMMYYYY(selectedDate);

    loadSlots(selectedDoctor, apiDate);
});


/* =========================
   LOAD SLOTS (FIXED)
========================= */
function loadSlots(doctor_id, date){

    if(!doctor_id || !date) return;

    fetch(`https://cep.prodoc.ai/api/v1/appointment/doctor-time-slots?doctorId=${doctor_id}&date=${date}`, {
        headers: {
            "Authorization": "Bearer " + token
        }
    })
    .then(res => res.json())
    .then(res => {

        slotBox.innerHTML = "";

        if(!res || !res.data || res.data.length === 0){
            slotBox.innerHTML = "<div class='text-warning'>No slots available</div>";
            return;
        }

        let slots = res.data[0]?.availableSlots || [];

        if(slots.length === 0){
            slotBox.innerHTML = "<div class='text-warning'>No available slots</div>";
            return;
        }

        slots.forEach(time => {

            let btn = document.createElement("button");
            btn.type = "button";
            btn.innerText = time;
            btn.classList.add("btn","btn-success","m-2");

            btn.onclick = function(){

                document.getElementById("appointment_slot").value = time;

                document.querySelectorAll("#slots button").forEach(b=>{
                    b.classList.remove("btn-primary");
                    b.classList.add("btn-success");
                });

                btn.classList.remove("btn-success");
                btn.classList.add("btn-primary");
            };

            slotBox.appendChild(btn);
        });

    })
    .catch(err => {
        slotBox.innerHTML = "<div class='text-danger'>Error loading slots</div>";
    });

}

/* =========================
   SUBMIT FORM (POSTMAN STYLE)
========================= */
document.getElementById("appointmentForm").addEventListener("submit", function(e){

    e.preventDefault();

    const appointment_with = document.getElementById("appointment_with")?.value || "";
    const name = document.getElementById("name")?.value || "";
    const email = document.getElementById("email")?.value || "";
    const phone = document.getElementById("phone")?.value || "";
    const appointment_date = document.getElementById("appointment_date")?.value || "";
    const appointment_slot = document.getElementById("appointment_slot")?.value || "";
    const comments = document.getElementById("comments")?.value || "";

    // safety check
    // if (!appointment_with || !name || !email || !phone || !appointment_date || !appointment_slot) {
    //     alert("All required fields must be filled");
    //     return;
    // }


    // 🔥 FIX DATE FORMAT (dd-mm-yyyy)
    const formattedDate = appointment_date.split("-").reverse().join("-");

    const payload = {
        appointment_with: appointment_with,
        appointment_date: formattedDate,
        appointment_slot: appointment_slot,
        comments: comments,
        name: name,
        phone: phone,
        email: email
    };

    

      fetch("ajax.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(payload)
    })
    .then(res => res.json())
    .then(data => {

        if(data.status){
            document.getElementById("msg").innerHTML =
            '<div class="alert alert-success">'+data.message+'</div>';

            this.reset();
            slotBox.innerHTML = "";
        }else{
            document.getElementById("msg").innerHTML =
            '<div class="alert alert-danger">'+data.message+'</div>';
        }

    })
    .catch(()=>{
        document.getElementById("msg").innerHTML =
        '<div class="alert alert-danger">Server Error</div>';
    });

});

</script>




<?php require_once('../footer.php'); ?>