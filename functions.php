<?php

if (!defined('__ROOTFROMFUNCTION__')) {
    define('__ROOTFROMFUNCTION__', dirname(__FILE__));
}
require_once(__ROOTFROMFUNCTION__ . '/db_connect.php');



// function for getting  the number of clicks per day  from the database

function get_numberofclicks_info()
{
    global $conn;
    $sql_clicks = "SELECT * FROM report_clicks  WHERE deleted = 'no' ORDER BY click_date DESC";
    $res_clicks = mysqli_query($conn, $sql_clicks);
    if (mysqli_num_rows($res_clicks)) {
        return (mysqli_fetch_all($res_clicks, MYSQLI_ASSOC));
    } else {
        return null;
    }
}


// function for seocontent started
// function for getting seocontent information from the database
function get_seocontent_info()
{
    global $conn;
    $sql_career = "SELECT * FROM seo_content WHERE deleted = 'no'";
    $res_career = mysqli_query($conn, $sql_career);
    if (mysqli_num_rows($res_career)) {
        return (mysqli_fetch_all($res_career, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



// function for inserting seocontent information into the database
function add_seocontent_info($category, $slug, $meta_title, $meta_description, $meta_keyword, $canonical)
{
    global $conn;
    // Escape special characters in the design and qualific variables
    $category = mysqli_real_escape_string($conn, $category);
    $slug = mysqli_real_escape_string($conn, $slug);
    $meta_title = mysqli_real_escape_string($conn, $meta_title);
    $meta_description = mysqli_real_escape_string($conn, $meta_description);
    $meta_keyword = mysqli_real_escape_string($conn, $meta_keyword);
    $canonical = mysqli_real_escape_string($conn, $canonical);

    // Construct SQL query
    $sql_insert_c = "INSERT INTO seo_content (category,slug,meta_title, meta_description, meta_keyword,canonical) VALUES ('$category','$slug','$meta_title', '$meta_description', '$meta_keyword','$canonical')";
    // Execute query
    $res_insert_c = mysqli_query($conn, $sql_insert_c);
    // Check if query was successful
    if ($res_insert_c) {
        return true;
    } else {
        return false;
    }
}

// function for update seocontent information into the database
function update_seocontent_info($id, $category, $slug, $meta_title, $meta_description, $meta_keyword, $canonical)
{
    global $conn;
    // Escape special characters in the design, qualific, and id variables
    $category = mysqli_real_escape_string($conn, $category);
    $slug = mysqli_real_escape_string($conn, $slug);
    $meta_title = mysqli_real_escape_string($conn, $meta_title);
    $meta_description = mysqli_real_escape_string($conn, $meta_description);
    $meta_keyword = mysqli_real_escape_string($conn, $meta_keyword);
    $canonical = mysqli_real_escape_string($conn, $canonical);

    $id = mysqli_real_escape_string($conn, $id);
    // Construct SQL query
    $sql_edit_career = "UPDATE seo_content SET category = '$category',slug = '$slug', meta_title = '$meta_title', meta_description = '$meta_description', meta_keyword = '$meta_keyword' , canonical = '$canonical' WHERE id = '$id'";
    // Execute query
    $res_insert_career = mysqli_query($conn, $sql_edit_career);
    // Check if query was successful
    if ($res_insert_career) {
        return true;
    } else {
        return false;
    }
}




// function for getting seocontent information from the database via ID
function get_seocontent_info_by($id)
{
    global $conn;
    $sql_career = "SELECT * FROM seo_content WHERE deleted = 'no' AND id ='$id'";
    $res_career = mysqli_query($conn, $sql_career);
    if (mysqli_num_rows($res_career)) {
        return (mysqli_fetch_all($res_career, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



// function for getting seocontent information from the database via ID
function get_seocontent_info_by_id($id)
{
    global $conn;
    $sql_career = "SELECT * FROM seo_content WHERE deleted = 'no' AND id ='$id'";
    $res_career = mysqli_query($conn, $sql_career);
    if (mysqli_num_rows($res_career)) {
        return (mysqli_fetch_assoc($res_career));
    } else {
        return null;
    }
}



// function for getting seocontent information from the database via slug
function get_seocontent_info_by_slug($slug)
{
    global $conn;

    // 1. Check in seo_content table
    $sql1 = "SELECT meta_title, meta_keyword, meta_description 
             FROM seo_content 
             WHERE deleted='no' AND slug='$slug' LIMIT 1";
    $res1 = mysqli_query($conn, $sql1);

    if (mysqli_num_rows($res1) > 0) {
        return mysqli_fetch_assoc($res1);
    }

    // 2. Check in department table
    $sql2 = "SELECT meta_title, meta_keyword, meta_description 
             FROM department 
             WHERE deleted='no' AND slug='$slug' LIMIT 1";
    $res2 = mysqli_query($conn, $sql2);

    if (mysqli_num_rows($res2) > 0) {
        return mysqli_fetch_assoc($res2);
    }

    // 3. Check in coe table
    $sql3 = "SELECT meta_title, meta_keyword, meta_description 
             FROM coe 
             WHERE deleted='no' AND coe_slug='$slug' LIMIT 1";
    $res3 = mysqli_query($conn, $sql3);

    if (mysqli_num_rows($res3) > 0) {
        return mysqli_fetch_assoc($res3);
    }

    // 4. If no record found anywhere
    return null;
}



// function for career started
// function for getting career information from the database
function get_career_info()
{
    global $conn;
    $sql_career = "SELECT * FROM career WHERE deleted = 'no'";
    $res_career = mysqli_query($conn, $sql_career);
    if (mysqli_num_rows($res_career)) {
        return (mysqli_fetch_all($res_career, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



// function for inserting career information into the database
function add_career_info($slug, $design, $qualific)
{
    global $conn;
    // Escape special characters in the design and qualific variables
    $slug = mysqli_real_escape_string($conn, $slug);
    $design = mysqli_real_escape_string($conn, $design);
    $qualific = mysqli_real_escape_string($conn, $qualific);
    // Construct SQL query
    $sql_insert_c = "INSERT INTO career (slug,design, qualific) VALUES ('$slug','$design', '$qualific')";
    // Execute query
    $res_insert_c = mysqli_query($conn, $sql_insert_c);
    // Check if query was successful
    if ($res_insert_c) {
        return true;
    } else {
        return false;
    }
}


// function for update career information into the database
function update_career_info($id, $slug, $design, $qualific)
{
    global $conn;
    // Escape special characters in the design, qualific, and id variables
    $slug = mysqli_real_escape_string($conn, $slug);
    $design = mysqli_real_escape_string($conn, $design);
    $qualific = mysqli_real_escape_string($conn, $qualific);
    $id = mysqli_real_escape_string($conn, $id);
    // Construct SQL query
    $sql_edit_career = "UPDATE career SET slug = '$slug', design = '$design', qualific = '$qualific' WHERE id = '$id'";
    // Execute query
    $res_insert_career = mysqli_query($conn, $sql_edit_career);
    // Check if query was successful
    if ($res_insert_career) {
        return true;
    } else {
        return false;
    }
}





// function for getting career information from the database via ID
function get_career_info_by($id)
{
    global $conn;
    $sql_career = "SELECT * FROM career WHERE deleted = 'no' AND id ='$id'";
    $res_career = mysqli_query($conn, $sql_career);
    if (mysqli_num_rows($res_career)) {
        return (mysqli_fetch_all($res_career, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



// function for getting career information from the database via ID
function get_career_info_by_id($id)
{
    global $conn;
    $sql_career = "SELECT * FROM career WHERE deleted = 'no' AND id ='$id'";
    $res_career = mysqli_query($conn, $sql_career);
    if (mysqli_num_rows($res_career)) {
        return (mysqli_fetch_assoc($res_career));
    } else {
        return null;
    }
}



// function for getting career information from the database via slug
function get_career_info_by_slug($slug)
{
    global $conn;
    $sql_career = "SELECT * FROM career WHERE deleted = 'no' AND slug ='$slug'";
    $res_career = mysqli_query($conn, $sql_career);
    if (mysqli_num_rows($res_career)) {
        return (mysqli_fetch_assoc($res_career));
    } else {
        return null;
    }
}



function get_career_info_hide_show()
{
    global $conn;
    $sql_career = "SELECT * FROM career WHERE  hide_show='1' AND deleted = 'no'";
    $res_career = mysqli_query($conn, $sql_career);
    if (mysqli_num_rows($res_career)) {
        return (mysqli_fetch_all($res_career, MYSQLI_ASSOC));
    } else {
        return null;
    }
}
// function for career end !!!




// function for DOCTORS started.....
// function for getting doctors information from the database
function get_doctors_info()
{
    global $conn;
    $sql_career = "SELECT * FROM doctors WHERE deleted = 'no'";
    $res_career = mysqli_query($conn, $sql_career);
    if (mysqli_num_rows($res_career)) {
        return (mysqli_fetch_all($res_career, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



// function for inserting doctors information into the database
function add_doctors_info($doc_slug, $doc_name, $doc_dept, $doc_dept_slug, $doctor_image)
{
    global $conn;
    // Prepare the SQL statement
    $sql_insert_d = "INSERT INTO doctors (doc_slug,doc_name,doc_dept,doc_dept_slug, image) VALUES (?,?, ?, ?,?)";
    $stmt = mysqli_prepare($conn, $sql_insert_d);
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sssss", $doc_slug, $doc_name, $doc_dept, $doc_dept_slug, $doctor_image);
    // Execute the statement
    $res_insert_d = mysqli_stmt_execute($stmt);
    return $res_insert_d ? true : false;
}



// function for update doctors information into the database
function update_doctors_info($id, $image, $doc_slug, $doc_name, $doc_dept, $doc_dept_slug)
{
    global $conn;
    // Prepare the SQL statement
    $sql_edit_doctors = "UPDATE doctors SET image = ?, doc_slug = ?, doc_name = ?, doc_dept = ?, doc_dept_slug = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql_edit_doctors);
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sssssi", $image, $doc_slug, $doc_name, $doc_dept, $doc_dept_slug, $id);
    // Execute the statement
    $res_insert_doctors = mysqli_stmt_execute($stmt);
    return $res_insert_doctors ? true : false;
}


// function for getting doctor information from the database via ID
function get_doctor_info_by($id)
{
    global $conn;
    $sql_doctor = "SELECT * FROM doctors WHERE deleted = 'no' AND id ='$id'";
    $res_doctor = mysqli_query($conn, $sql_doctor);
    if (mysqli_num_rows($res_doctor)) {
        return (mysqli_fetch_all($res_doctor, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



// function for getting doctor information from the database via ID
function get_doctor_info_by_slug($slug)
{
    global $conn;
    $sql_doctor = "SELECT * FROM doctors WHERE deleted = 'no' AND doc_slug ='$slug'";
    $res_doctor = mysqli_query($conn, $sql_doctor);
    if (mysqli_num_rows($res_doctor)) {
        return (mysqli_fetch_all($res_doctor, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



function get_doctor_info_by_deptid($id)
{
    global $conn;
    $sql_doctor = "SELECT * FROM doctors WHERE deleted = 'no' AND doc_dept ='$id'";
    $res_doctor = mysqli_query($conn, $sql_doctor);
    if (mysqli_num_rows($res_doctor)) {
        return (mysqli_fetch_all($res_doctor, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



function get_doctors_info_limit_rand()
{
    global $conn;
    $sql_career = "SELECT * FROM doctors WHERE deleted = 'no' AND hide_show='1' ORDER BY RAND() LIMIT 4";
    $res_career = mysqli_query($conn, $sql_career);
    if (mysqli_num_rows($res_career)) {
        return (mysqli_fetch_all($res_career, MYSQLI_ASSOC));
    } else {
        return null;
    }
}




function get_doctors_info_priority()
{
    global $conn;
    $sql_career = "SELECT * FROM doctors WHERE deleted = 'no' AND hide_show='1' AND priority > 0 ORDER BY priority ASC";
    $res_career = mysqli_query($conn, $sql_career);
    if (mysqli_num_rows($res_career) > 0) {
        $doctors = mysqli_fetch_all($res_career, MYSQLI_ASSOC);
        // Group doctors by priority
        $grouped_doctors = [];
        foreach ($doctors as $doctor) {
            $grouped_doctors[$doctor['priority']][] = $doctor;
        }
        // Shuffle each group and flatten the array
        $shuffled_doctors = [];
        foreach ($grouped_doctors as $priority_group) {
            shuffle($priority_group);
            $shuffled_doctors = array_merge($shuffled_doctors, $priority_group);
        }
        return $shuffled_doctors;
    } else {
        return null;
    }
}





function get_doctor_info_by_deptid_cat($id)
{
    global $conn;
    $sql_doctor = "SELECT * FROM doctors WHERE deleted = 'no' AND hide_show='1' AND doc_dept ='$id'";
    $res_doctor = mysqli_query($conn, $sql_doctor);
    if (mysqli_num_rows($res_doctor)) {
        return (mysqli_fetch_all($res_doctor, MYSQLI_ASSOC));
    } else {
        return null;
    }
}


function get_doctor_info_by_deptslug_cat($dept_slug)
{
    global $conn;
    $sql_doctor = "SELECT * FROM doctors WHERE deleted = 'no' AND hide_show='1' AND doc_dept_slug ='$dept_slug'";
    $res_doctor = mysqli_query($conn, $sql_doctor);
    if (mysqli_num_rows($res_doctor)) {
        return (mysqli_fetch_all($res_doctor, MYSQLI_ASSOC));
    } else {
        return null;
    }
}

function get_doctors_info_hide_show()
{
    global $conn;
    $sql_career = "SELECT * FROM doctors WHERE  hide_show='1' AND deleted = 'no'";
    $res_career = mysqli_query($conn, $sql_career);
    if (mysqli_num_rows($res_career)) {
        return (mysqli_fetch_all($res_career, MYSQLI_ASSOC));
    } else {
        return null;
    }
}




function get_doctor_info_by_deptid_wise($id)
{
    global $conn;
    $sql_doctor = "SELECT * FROM doctors WHERE deleted = 'no' AND doc_dept ='$id' AND hide_show='1' ";
    $res_doctor = mysqli_query($conn, $sql_doctor);
    if (mysqli_num_rows($res_doctor)) {
        return (mysqli_fetch_all($res_doctor, MYSQLI_ASSOC));
    } else {
        return null;
    }
}

function get_doctor_info_by_deptslug_wise($slug)
{
    global $conn;
    $sql_doctor = "SELECT * FROM doctors WHERE deleted = 'no' AND doc_dept_slug ='$slug' AND hide_show='1' ";
    $res_doctor = mysqli_query($conn, $sql_doctor);
    if (mysqli_num_rows($res_doctor)) {
        return (mysqli_fetch_all($res_doctor, MYSQLI_ASSOC));
    } else {
        return null;
    }
}


function DoctorUploadImage($uploadedImage, $uploadDestination)
{
    // Check if file was uploaded without errors
    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $uploadedImage['tmp_name'];
        // Generate a unique file name to prevent overwriting existing files
        $fileName = uniqid() . '_' . $uploadedImage['name'];
        // Build the target file path
        $targetFilePath = $uploadDestination . '/' . $fileName;
        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully
            return $fileName;
        } else {
            // Error moving the file
            return false;
        }
    } else {
        // Error uploading the file
        return false;
    }
}




function DoctorUpdateImage($oldImageLink, $newImage, $destination)
{
    // Check if the new image was uploaded without errors
    if ($newImage['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $newImage['tmp_name'];
        // Generate a unique file name to prevent overwriting existing files
        $fileName = uniqid() . '_' . $newImage['name'];
        // Build the target file path
        $targetFilePath = $destination . '/' . $fileName;
        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully, delete the old image if it exists
            if (file_exists($oldImageLink)) {
                unlink($oldImageLink);
            }
            // Return the new image link
            return $fileName;
        } else {
            // Error moving the file
            return $oldImageLink; // Return the old image link if there was an error
        }
    } else {
        // Error uploading the new image
        return $oldImageLink; // Return the old image link if there was an error
    }
}



// Functions for doctors profile
// function for getting profile information from the database
function get_profile_info()
{
    global $conn;
    $sql_profile = "SELECT * FROM doc_profile WHERE deleted = 'no'";
    $res_profile = mysqli_query($conn, $sql_profile);
    if (mysqli_num_rows($res_profile)) {
        return (mysqli_fetch_all($res_profile, MYSQLI_ASSOC));
    } else {
        return null;
    }
}


// function for inserting profile information into the database
function add_profile_info($speciality, $education, $experience, $time, $doc_id, $doc_slug, $description, $education_title, $zceppa, $zceppa_social, $meta_keyword, $meta_description, $meta_title)
{
    global $conn;
    // Prepare the SQL statement
    $sql_insert_p = "INSERT INTO doc_profile (speciality, education, experience, `time`, doc_id,doc_slug, description, education_title, zceppa, zceppa_social,meta_keyword, meta_description, meta_title) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)";
    $stmt = mysqli_prepare($conn, $sql_insert_p);
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sssssssssssss", $speciality, $education, $experience, $time, $doc_id, $doc_slug, $description, $education_title, $zceppa, $zceppa_social, $meta_keyword, $meta_description, $meta_title);
    // Execute the statement
    $res_insert_p = mysqli_stmt_execute($stmt);
    return $res_insert_p ? true : false;
}



// function for update profile information into the database
function update_profile_info($id, $speciality, $education, $experience, $time, $description, $education_title, $zceppa, $zceppa_social, $meta_keyword, $meta_description, $meta_title)
{
    global $conn;
    // Prepare the SQL statement
    $sql_edit_profile = "UPDATE doc_profile SET speciality = ?, education = ?, experience = ?, `time` = ?, description = ?, education_title = ?, zceppa = ?, zceppa_social = ?, meta_keyword = ?, meta_description = ?, meta_title = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql_edit_profile);
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sssssssssssi", $speciality, $education, $experience, $time, $description, $education_title, $zceppa, $zceppa_social, $meta_keyword, $meta_description, $meta_title, $id);
    // Execute the statement
    $res_insert_profile = mysqli_stmt_execute($stmt);
    return $res_insert_profile ? true : false;
}


// function for getting profile information from the database via ID
function get_profile_info_by_docid($id)
{
    global $conn;
    $sql_profile = "SELECT * FROM doc_profile WHERE deleted = 'no' AND doc_id ='$id' ";
    $res_profile = mysqli_query($conn, $sql_profile);
    if (mysqli_num_rows($res_profile)) {
        return (mysqli_fetch_all($res_profile, MYSQLI_ASSOC));
    } else {
        return null;
    }
}




// function for getting profile information from the database via ID
function get_profile_info_by_docslug($doc_slug)
{
    global $conn;
    $sql_profile = "SELECT * FROM doc_profile WHERE deleted = 'no' AND doc_slug ='$doc_slug' ";
    $res_profile = mysqli_query($conn, $sql_profile);
    if (mysqli_num_rows($res_profile)) {
        return (mysqli_fetch_all($res_profile, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



function get_profile_info_by($id)
{
    global $conn;
    $sql_profile = "SELECT * FROM doc_profile WHERE deleted = 'no' AND id ='$id' ";
    $res_profile = mysqli_query($conn, $sql_profile);
    if (mysqli_num_rows($res_profile)) {
        return (mysqli_fetch_all($res_profile, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



//  inserting academics information 
function add_academics_info($title, $description, $youtube_link)
{
    global $conn;
    // Prepare the SQL statement
    $sql_insert = "INSERT INTO academics (title, description, youtube_link) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql_insert);
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sss", $title, $description, $youtube_link);
    // Execute the statement
    $res_insert = mysqli_stmt_execute($stmt);
    return $res_insert ? true : false;
}





//  academics information 
function get_academics_info()
{
    global $conn;
    $sql_academics = "SELECT * FROM academics WHERE deleted = 'no' ";
    $res_academics = mysqli_query($conn, $sql_academics);
    if (mysqli_num_rows($res_academics)) {
        return (mysqli_fetch_all($res_academics, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



// update academics information
function update_academics_info($id, $title, $description, $youtube_link)
{
    global $conn;
    // Prepare the SQL statement
    $sql_update_academics = "UPDATE academics SET title = ?, description = ?, youtube_link = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql_update_academics);
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sssi", $title, $description, $youtube_link, $id);
    // Execute the statement
    $res_update_academics = mysqli_stmt_execute($stmt);
    return $res_update_academics ? true : false;
}



//  getting academics information by id
function get_academics_info_by($id)
{
    global $conn;
    $sql_academics = "SELECT * FROM academics WHERE deleted = 'no' AND id ='$id'";
    $res_academics = mysqli_query($conn, $sql_academics);
    if (mysqli_num_rows($res_academics)) {
        return (mysqli_fetch_all($res_academics, MYSQLI_ASSOC));
    } else {
        return null;
    }
}




function get_academics_info_limit_desc()
{

    global $conn;
    $sql_academics = "SELECT * FROM academics WHERE deleted = 'no' ORDER BY id DESC LIMIT 3 ";
    $res_academics = mysqli_query($conn, $sql_academics);
    if (mysqli_num_rows($res_academics)) {
        return (mysqli_fetch_all($res_academics, MYSQLI_ASSOC));
    } else {
        return null;
    }
}

// function for academics end !!!


//  inserting FAQ information 
function add_faq_info($title, $description)
{
    global $conn;
    // Escape special characters in the title and description variables
    $title = mysqli_real_escape_string($conn, $title);
    $description = mysqli_real_escape_string($conn, $description);
    // Construct SQL query
    $sql_insert = "INSERT INTO faq (title, description) VALUES ('$title', '$description')";
    // Execute query
    $res_insert = mysqli_query($conn, $sql_insert);
    // Check if query was successful
    if ($res_insert) {
        return true;
    } else {
        return false;
    }
}



//  FAQ information 
function get_faq_info()
{
    global $conn;
    $sql_faq = "SELECT * FROM faq WHERE deleted = 'no' ";
    $res_faq = mysqli_query($conn, $sql_faq);
    if (mysqli_num_rows($res_faq)) {
        return (mysqli_fetch_all($res_faq, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



// update FAQ information
function update_faq_info($id, $title, $description)
{
    global $conn;
    // Escape special characters in the title, description, and id variables
    $title = mysqli_real_escape_string($conn, $title);
    $description = mysqli_real_escape_string($conn, $description);
    $id = mysqli_real_escape_string($conn, $id);
    // Construct SQL query
    $sql_update_faq = "UPDATE faq SET title = '$title', description = '$description' WHERE id = '$id'";
    // Execute query
    $res_update_faq = mysqli_query($conn, $sql_update_faq);
    // Check if query was successful
    if ($res_update_faq) {
        return true;
    } else {
        return false;
    }
}



//  getting FAQ information by id
function get_faq_info_by($id)
{
    global $conn;
    $sql_faq = "SELECT * FROM faq WHERE deleted = 'no' AND id ='$id'";
    $res_faq = mysqli_query($conn, $sql_faq);
    if (mysqli_num_rows($res_faq)) {
        return (mysqli_fetch_all($res_faq, MYSQLI_ASSOC));
    } else {
        return null;
    }
}

// function for FAQ end !!!



   
// website details information 

function get_website_info()
{
    global $conn;
    $sql_website = "SELECT * FROM website_details WHERE deleted = 'no' ";
    $res_website = mysqli_query($conn, $sql_website);
    if (mysqli_num_rows($res_website)) {
        return (mysqli_fetch_all($res_website, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



// update website details information
function update_website_info(
    $id,
    $happy_customer,
    $year_of_experience,
    $specialist,
    $beds,
    $facebook,
    $instagram,
    $youtube,
    $linkedin,
    $address,
    $mobile_number,
    $email,
    $short_desc,
    $doc_title,
    $doc_desc,
    $emergency_number,
    $appointment,
    $report,
    $get_direction,
    $coe_title,
    $coe_desc,
    $special_title,
    $special_desc,
    $google_review,
    $zceppa_social,
    $website_link,
    $home_collection,
    $admission_enquiry,
    $whatsapp,
    $meta_title,
    $meta_keyword,
    $meta_description,
    $about_keyword,
    $about_description,
    $alliance_keyword,
    $alliance_description,
    $testimonial_keyword,
    $testimonial_description,
    $doctors_keyword,
    $doctors_description,
    $hpackage_keyword,
    $hpackage_description,
    $news_keyword,
    $news_description,
    $contact_keyword,
    $contact_description,
    $career_keyword,
    $career_description,
    $academics_keyword,
    $academics_description,
    $techno_keyword,
    $techno_description,
    $privacy_keyword,
    $privacy_description,
    $legal_keyword,
    $legal_description,
    $about_title,
    $alliance_title,
    $testimonial_title,
    $doctors_title,
    $hpackage_title,
    $news_title,
    $contact_title,
    $career_title,
    $academics_title,
    $techno_title,
    $privacy_title,
    $legal_title,
    $career_email,
    $hpackage_email
) {
    global $conn;

    // Prepare the SQL statement
    $sql_update_website = "UPDATE website_details SET happy_customer=?, year_of_experience=?, specialist=?, beds=?, facebook=?, instagram=?, youtube=?, linkedin=?, address=?, mobile_number=?, email=?, short_desc=?, doc_title=?, doc_desc=?, emergency_number=?, appointment=?, report=?, get_direction=?, coe_title=?, coe_desc=?, special_title=?, special_desc=?, google_review=?, zceppa_social=?, website_link=?, home_collection=?, admission_enquiry=?, whatsapp=?, meta_title=?, meta_keyword=?, meta_description=?, about_keyword=?, about_description=?, alliance_keyword=?, alliance_description=?, testimonial_keyword=?, testimonial_description=?, doctors_keyword=?, doctors_description=?, hpackage_keyword=?, hpackage_description=?, news_keyword=?, news_description=?, contact_keyword=?, contact_description=?, career_keyword=?, career_description=?, academics_keyword=?, academics_description=?, techno_keyword=?, techno_description=?, privacy_keyword=?, privacy_description=?, legal_keyword=?, legal_description=?, about_title=?, alliance_title=?, testimonial_title=?, doctors_title=?, hpackage_title=?, news_title=?, contact_title=?, career_title=?, academics_title=?, techno_title=?, privacy_title=?, legal_title=?, career_email=?, hpackage_email=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql_update_website);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssi", $happy_customer, $year_of_experience, $specialist, $beds, $facebook, $instagram, $youtube, $linkedin, $address, $mobile_number, $email, $short_desc, $doc_title, $doc_desc, $emergency_number, $appointment, $report, $get_direction, $coe_title, $coe_desc, $special_title, $special_desc, $google_review, $zceppa_social, $website_link, $home_collection, $admission_enquiry, $whatsapp, $meta_title, $meta_keyword, $meta_description, $about_keyword, $about_description, $alliance_keyword, $alliance_description, $testimonial_keyword, $testimonial_description, $doctors_keyword, $doctors_description, $hpackage_keyword, $hpackage_description, $news_keyword, $news_description, $contact_keyword, $contact_description, $career_keyword, $career_description, $academics_keyword, $academics_description, $techno_keyword, $techno_description, $privacy_keyword, $privacy_description, $legal_keyword, $legal_description, $about_title, $alliance_title, $testimonial_title, $doctors_title, $hpackage_title, $news_title, $contact_title, $career_title, $academics_title, $techno_title, $privacy_title, $legal_title, $career_email, $hpackage_email, $id);

    // Execute the statement
    $res_update_website = mysqli_stmt_execute($stmt);
    if ($res_update_website) {
        return true;
    } else {
        return false;
    }
}

// function for website details end !!!



//  inserting alliance information 

function add_alliance_info($name, $image)
{
    global $conn;
    // Check if name and image are not empty
    if (!empty($name) && !empty($image)) {
        // Escape special characters in the name and image variables
        $name = mysqli_real_escape_string($conn, $name);
        $image = mysqli_real_escape_string($conn, $image);
        // Construct SQL query
        $sql_alliance = "INSERT INTO alliance (name, image) VALUES ('$name', '$image')";
        // Execute query
        $res_alliance = mysqli_query($conn, $sql_alliance);
        // Check if query was successful
        if ($res_alliance) {
            return true;
        } else {
            return false;
        }
    } else {
        // Return false if name or image is empty
        return false;
    }
}



//   allaince information 
function get_alliance_info()
{
    global $conn;
    $sql_alliance = "SELECT * FROM alliance WHERE deleted = 'no'";
    $res_alliance = mysqli_query($conn, $sql_alliance);
    if (mysqli_num_rows($res_alliance)) {
        return (mysqli_fetch_all($res_alliance, MYSQLI_ASSOC));
    } else {
        return null;
    }
}





//  update alliance information 
function update_alliance_info($id, $image, $name)
{
    global $conn;
    // Escape special characters in the image, name, and id variables
    $image = mysqli_real_escape_string($conn, $image);
    $name = mysqli_real_escape_string($conn, $name);
    $id = mysqli_real_escape_string($conn, $id);
    // Construct SQL query
    $sql_alliance = "UPDATE alliance SET image = '$image', name = '$name' WHERE id = '$id'";
    // Execute query
    $res_alliance = mysqli_query($conn, $sql_alliance);
    // Check if query was successful
    if ($res_alliance) {
        return true;
    } else {
        return false;
    }
}




// alliance information by ID
function get_alliance_info_by($id)
{
    global $conn;
    $res_alliance = "SELECT * FROM alliance WHERE deleted = 'no' AND id ='$id'";
    $res_alliance = mysqli_query($conn, $res_alliance);
    if (mysqli_num_rows($res_alliance)) {
        return (mysqli_fetch_all($res_alliance, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



// alliance upload image
function AllianceUploadImage($uploadedImage, $uploadDestination)
{
    // Check if file was uploaded without errors
    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $uploadedImage['tmp_name'];
        // Generate a unique file name to prevent overwriting existing files
        $fileName = uniqid() . '_' . $uploadedImage['name'];
        // Build the target file path
        $targetFilePath = $uploadDestination . '/' . $fileName;
        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully
            return $fileName;
        } else {
            // Error moving the file
            return false;
        }
    } else {
        // Error uploading the file
        return false;
    }
}





// alliance update image

function AllianceUpdateImage($oldImageLink, $newImage, $destination)
{
    // Check if the new image was uploaded without errors
    if ($newImage['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $newImage['tmp_name'];
        // Generate a unique file name to prevent overwriting existing files
        $fileName = uniqid() . '_' . $newImage['name'];
        // Build the target file path
        $targetFilePath = $destination . '/' . $fileName;
        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully, delete the old image if it exists
            if (file_exists($oldImageLink)) {
                unlink($oldImageLink);
            }
            // Return the new image link
            return $fileName;
        } else {
            // Error moving the file
            return $oldImageLink; // Return the old image link if there was an error
        }
    } else {
        // Error uploading the new image
        return $oldImageLink; // Return the old image link if there was an error
    }
}

// function for allaince details end !!!



//  inserting health package information 

function add_healthpackage_info($slug, $name, $old_price, $price, $image)
{
    global $conn;
    $sql_healthpackage = "INSERT INTO health_package (slug,package_name,old_price,price,image)
                   Values('$slug','$name','$old_price','$price','$image')";
    $res_healthpackage = mysqli_query($conn, $sql_healthpackage);
    if ($res_healthpackage) {
        return True;
    } else {
        return False;
    }
}



//   health package information 
function get_healthpackage_info()
{
    global $conn;
    $sql_healthpackage = "SELECT * FROM health_package WHERE deleted = 'no'";
    $res_healthpackage = mysqli_query($conn, $sql_healthpackage);
    if (mysqli_num_rows($res_healthpackage)) {
        return (mysqli_fetch_all($res_healthpackage, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



//  update health package information 
function update_healthpackage_info($id, $slug, $name, $old_price, $price, $image)
{
    global $conn;
    // Escape special characters in variables
    $id = mysqli_real_escape_string($conn, $id);
    $slug = mysqli_real_escape_string($conn, $slug);
    $name = mysqli_real_escape_string($conn, $name);
    $old_price = mysqli_real_escape_string($conn, $old_price);
    $price = mysqli_real_escape_string($conn, $price);
    $image = mysqli_real_escape_string($conn, $image);
    // Construct SQL query
    $sql_healthpackage = "UPDATE health_package SET slug = '$slug', package_name = '$name', old_price = '$old_price', price = '$price', image = '$image' WHERE id = '$id';";
    // Execute query
    $res_healthpackage = mysqli_query($conn, $sql_healthpackage);
    // Check if query was successful
    if ($res_healthpackage) {
        return true;
    } else {
        return false;
    }
}





// health package information by ID

function get_healthpackage_info_by($id)
{
    global $conn;
    $sql_healthpackage = "SELECT * FROM health_package WHERE deleted = 'no' AND id ='$id'";
    $sql_healthpackage = mysqli_query($conn, $sql_healthpackage);
    if (mysqli_num_rows($sql_healthpackage)) {
        return (mysqli_fetch_all($sql_healthpackage, MYSQLI_ASSOC));
    } else {
        return null;
    }
}


// health package information by ID

function get_healthpackage_info_by_slug($slug)
{
    global $conn;
    $sql_healthpackage = "SELECT * FROM health_package WHERE deleted = 'no' AND slug ='$slug'";
    $sql_healthpackage = mysqli_query($conn, $sql_healthpackage);
    if (mysqli_num_rows($sql_healthpackage)) {
        return (mysqli_fetch_all($sql_healthpackage, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



// health package information by ID

function get_health_package_info_by($id)
{
    global $conn;
    $sql_healthpackage = "SELECT * FROM health_package WHERE deleted = 'no' AND id ='$id'";
    $sql_healthpackage = mysqli_query($conn, $sql_healthpackage);
    if (mysqli_num_rows($sql_healthpackage)) {
        return (mysqli_fetch_assoc($sql_healthpackage));
    } else {
        return null;
    }
}



// health package information by slug

function get_health_package_info_by_slug($slug)
{
    global $conn;
    $sql_healthpackage = "SELECT * FROM health_package WHERE deleted = 'no' AND slug ='$slug'";
    $sql_healthpackage = mysqli_query($conn, $sql_healthpackage);
    if (mysqli_num_rows($sql_healthpackage)) {
        return (mysqli_fetch_assoc($sql_healthpackage));
    } else {
        return null;
    }
}



// health package upload image

function healthpackageUploadImage($uploadedImage, $uploadDestination)
{
    // Check if file was uploaded without errors
    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $uploadedImage['tmp_name'];
        // Generate a unique file name to prevent overwriting existing files
        $fileName = uniqid() . '_' . $uploadedImage['name'];
        // Build the target file path
        $targetFilePath = $uploadDestination . '/' . $fileName;
        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully
            return $fileName;
        } else {
            // Error moving the file
            return false;
        }
    } else {
        // Error uploading the file
        return false;
    }
}




// health package update image

function healthpackageUpdateImage($oldImageLink, $newImage, $destination)
{
    // Check if the new image was uploaded without errors
    if ($newImage['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $newImage['tmp_name'];
        // Generate a unique file name to prevent overwriting existing files
        $fileName = uniqid() . '_' . $newImage['name'];
        // Build the target file path
        $targetFilePath = $destination . '/' . $fileName;
        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully, delete the old image if it exists
            if (file_exists($oldImageLink)) {
                unlink($oldImageLink);
            }
            // Return the new image link
            return $fileName;
        } else {
            // Error moving the file
            return $oldImageLink; // Return the old image link if there was an error
        }
    } else {
        // Error uploading the new image
        return $oldImageLink; // Return the old image link if there was an error
    }
}

// function for health package details end !!!




//  inserting  package list  

function add_packagelist_info($list, $package_id)
{
    global $conn;
    // Escape special characters in the list and package_id variables
    $list = mysqli_real_escape_string($conn, $list);
    $package_id = mysqli_real_escape_string($conn, $package_id);
    // Construct SQL query
    $sql_packagelist = "INSERT INTO package_list (list, package_id) VALUES ('$list', '$package_id')";
    // Execute query
    $res_packagelist = mysqli_query($conn, $sql_packagelist);
    // Check if query was successful
    if ($res_packagelist) {
        return true;
    } else {
        return false;
    }
}






//  getting package list 

function get_packagelist_info()

{
    global $conn;
    $sql_packagelist = "SELECT * FROM package_list WHERE deleted = 'no'";
    $res_packagelist = mysqli_query($conn, $sql_packagelist);
    if (mysqli_num_rows($res_packagelist)) {
        return (mysqli_fetch_all($res_packagelist, MYSQLI_ASSOC));
    } else {
        return null;
    }
}











//  update package list



function update_packagelist_info($id, $list)
{
    global $conn;

    // Escape special characters in the list variable
    $id = mysqli_real_escape_string($conn, $id);
    $list = mysqli_real_escape_string($conn, $list);

    // Construct SQL query
    $sql_packagelist = "UPDATE package_list SET list = '$list' WHERE id = '$id';";

    // Execute query
    $res_packagelist = mysqli_query($conn, $sql_packagelist);

    // Check if query was successful
    if ($res_packagelist) {
        return true;
    } else {
        return false;
    }
}






//  getting package list via ID



function get_packagelist_info_by_packageid($id)

{





    global $conn;



    $sql_packagelist = "SELECT * FROM package_list WHERE deleted = 'no' AND package_id ='$id' ";



    $res_packagelist = mysqli_query($conn, $sql_packagelist);



    if (mysqli_num_rows($res_packagelist)) {

        return (mysqli_fetch_all($res_packagelist, MYSQLI_ASSOC));
    } else {

        return null;
    }
}







function get_packagelist_info_by($id)

{





    global $conn;



    $sql_packagelist = "SELECT * FROM package_list WHERE deleted = 'no' AND id ='$id' ";



    $res_packagelist = mysqli_query($conn, $sql_packagelist);



    if (mysqli_num_rows($res_packagelist)) {

        return (mysqli_fetch_all($res_packagelist, MYSQLI_ASSOC));
    } else {

        return null;
    }
}











function get_packagelist_by_packageid($id)

{





    global $conn;



    $sql_packagelist = "SELECT * FROM package_list WHERE deleted = 'no' AND package_id ='$id' ";



    $res_packagelist = mysqli_query($conn, $sql_packagelist);



    if (mysqli_num_rows($res_packagelist)) {

        return (mysqli_fetch_all($res_packagelist, MYSQLI_ASSOC));
    } else {

        return null;
    }
}





// function for package list details end !!!























//  inserting  package details 





function add_packagedetails_info($details, $list_id)
{
    global $conn;

    // Escape special characters in the details and list_id variables
    $details = mysqli_real_escape_string($conn, $details);
    $list_id = mysqli_real_escape_string($conn, $list_id);

    // Construct SQL query
    $sql_packagedetails = "INSERT INTO package_details (details, list_id) VALUES ('$details', '$list_id')";

    // Execute query
    $res_packagedetails = mysqli_query($conn, $sql_packagedetails);

    // Check if query was successful
    if ($res_packagedetails) {
        return true;
    } else {
        return false;
    }
}






//  getting package details 



function get_packagedetails_info()

{





    global $conn;



    $sql_packagedetails = "SELECT * FROM package_details WHERE deleted = 'no'";



    $res_packagedetails = mysqli_query($conn, $sql_packagedetails);



    if (mysqli_num_rows($res_packagedetails)) {

        return (mysqli_fetch_all($res_packagedetails, MYSQLI_ASSOC));
    } else {

        return null;
    }
}











//  update package details



function update_packagedetails_info($id, $details)
{
    global $conn;

    // Escape special characters in the details variable
    $id = mysqli_real_escape_string($conn, $id);
    $details = mysqli_real_escape_string($conn, $details);

    // Construct SQL query
    $sql_packagedetails = "UPDATE package_details SET details = '$details' WHERE id = '$id';";

    // Execute query
    $res_packagedetails = mysqli_query($conn, $sql_packagedetails);

    // Check if query was successful
    if ($res_packagedetails) {
        return true;
    } else {
        return false;
    }
}





//  getting package details via ID



function get_packagedetails_info_by_packagelist($id)

{





    global $conn;



    $sql_packagedetails = "SELECT * FROM package_details WHERE deleted = 'no' AND list_id ='$id' ";



    $res_packagedetails = mysqli_query($conn, $sql_packagedetails);



    if (mysqli_num_rows($res_packagedetails)) {

        return (mysqli_fetch_all($res_packagedetails, MYSQLI_ASSOC));
    } else {

        return null;
    }
}







function get_packagedetails_info_by($id)

{





    global $conn;



    $sql_packagedetails = "SELECT * FROM package_details WHERE deleted = 'no' AND id ='$id' ";



    $res_packagedetails = mysqli_query($conn, $sql_packagedetails);



    if (mysqli_num_rows($res_packagedetails)) {

        return (mysqli_fetch_all($res_packagedetails, MYSQLI_ASSOC));
    } else {

        return null;
    }
}





// function for package details details end !!!














//  inserting queries information 





function add_queries_info($name, $number, $queryemail, $preffered_time, $message)

{

    global $conn;

    $sql_queries = "INSERT INTO queries (name,number,email,preffered_time,message)

                   Values('$name','$number','$queryemail','$preffered_time','$message')";

    $res_queries = mysqli_query($conn, $sql_queries);



    if ($res_queries) {

        return True;
    } else {

        return False;
    }
}







//  queries information 







function get_queries_info()

{





    global $conn;



    $sql_queries = "SELECT * FROM queries WHERE deleted = 'no' ";



    $res_queries = mysqli_query($conn, $sql_queries);



    if (mysqli_num_rows($res_queries)) {

        return (mysqli_fetch_all($res_queries, MYSQLI_ASSOC));
    } else {

        return null;
    }
}









function get_queries_info_desc()

{





    global $conn;





    $sql_queries = "SELECT * FROM queries WHERE deleted = 'no' ORDER BY id DESC ";



    $res_queries = mysqli_query($conn, $sql_queries);



    if (mysqli_num_rows($res_queries)) {

        return (mysqli_fetch_all($res_queries, MYSQLI_ASSOC));
    } else {

        return null;
    }
}





// function for queries end !!!














//  inserting  admission enqueries information 





function add_admission_queries_info($name, $number, $queryemail, $department, $disease, $other_details)

{

    global $conn;

    $sql_queries = "INSERT INTO  admission_enquiry (name,number,email,department,disease,other_details)

                   Values('$name','$number','$queryemail','$department','$disease','$other_details')";

    $res_queries = mysqli_query($conn, $sql_queries);



    if ($res_queries) {

        return True;
    } else {

        return False;
    }
}







//  admission enqueries information 







function get_admission_queries_info()

{





    global $conn;



    $sql_queries = "SELECT * FROM admission_enquiry WHERE deleted = 'no' ";



    $res_queries = mysqli_query($conn, $sql_queries);



    if (mysqli_num_rows($res_queries)) {

        return (mysqli_fetch_all($res_queries, MYSQLI_ASSOC));
    } else {

        return null;
    }
}









function get_admission_queries_info_desc()

{





    global $conn;





    $sql_queries = "SELECT * FROM admission_enquiry WHERE deleted = 'no' ORDER BY id DESC ";



    $res_queries = mysqli_query($conn, $sql_queries);



    if (mysqli_num_rows($res_queries)) {

        return (mysqli_fetch_all($res_queries, MYSQLI_ASSOC));
    } else {

        return null;
    }
}





// function for admission enqueries end !!!















//  inserting banner section information 





function add_banner_info($title, $description, $image, $mobile_image)
{
    global $conn;

    // Escape special characters in the title, description, and image variables
    $title = mysqli_real_escape_string($conn, $title);
    $description = mysqli_real_escape_string($conn, $description);
    $image = mysqli_real_escape_string($conn, $image);
    $mobile_image = mysqli_real_escape_string($conn, $mobile_image);

    // Construct SQL query
    $sql_banner = "INSERT INTO banner (title, description, image,mobile_image) VALUES ('$title', '$description', '$image', '$mobile_image')";

    // Execute query
    $res_banner = mysqli_query($conn, $sql_banner);

    // Check if query was successful
    if ($res_banner) {
        return true;
    } else {
        return false;
    }
}








//    banner section information 

function get_banner_info()

{





    global $conn;



    $sql_banner = "SELECT * FROM banner WHERE deleted = 'no'";



    $res_banner = mysqli_query($conn, $sql_banner);



    if (mysqli_num_rows($res_banner)) {

        return (mysqli_fetch_all($res_banner, MYSQLI_ASSOC));
    } else {

        return null;
    }
}









//  update  banner section information 



function update_banner_info($id, $title, $description, $image, $mobile_image)
{
    global $conn;

    // Escape special characters in the title, description, image, and id variables
    $title = mysqli_real_escape_string($conn, $title);
    $description = mysqli_real_escape_string($conn, $description);
    $image = mysqli_real_escape_string($conn, $image);
    $mobile_image = mysqli_real_escape_string($conn, $mobile_image);
    $id = mysqli_real_escape_string($conn, $id);

    // Construct SQL query
    $sql_banner = "UPDATE banner SET title = '$title', description = '$description', image = '$image', mobile_image = '$mobile_image' WHERE id = '$id'";

    // Execute query
    $res_banner = mysqli_query($conn, $sql_banner);

    // Check if query was successful
    if ($res_banner) {
        return true;
    } else {
        return false;
    }
}







//  banner section information by ID



function get_banner_info_by($id)

{





    global $conn;



    $sql_banner = "SELECT * FROM banner WHERE deleted = 'no' AND id ='$id'";



    $res_banner = mysqli_query($conn, $sql_banner);



    if (mysqli_num_rows($res_banner)) {

        return (mysqli_fetch_all($res_banner, MYSQLI_ASSOC));
    } else {

        return null;
    }
}







//  banner section upload image



function BannerUploadImage($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}








function MobileBannerUploadImage($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}



//  banner section update image





function BannerUpdateImage($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}








function MobileBannerUpdateImage($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}


// function for  banner section details end !!!






//  inserting for news  section information 



function add_awards_info($slug, $title, $post_date, $post_desc, $image)
{
    global $conn;

    // Escape special characters in the title and image variables
    $slug = mysqli_real_escape_string($conn, $slug);
    $title = mysqli_real_escape_string($conn, $title);
    $post_date = mysqli_real_escape_string($conn, $post_date);
    $post_desc = mysqli_real_escape_string($conn, $post_desc);
    $image = mysqli_real_escape_string($conn, $image);

    // Construct SQL query
    $sql_awards = "INSERT INTO awards_accolades (slug,title, post_date,post_desc, image) VALUES ('$slug'  ,'$title'  , '$post_date' , '$post_desc' , '$image')";

    // Execute query
    $res_awards = mysqli_query($conn, $sql_awards);

    // Check if query was successful
    if ($res_awards) {
        return true;
    } else {
        return false;
    }
}








//    award&accolades section information 

function get_awards_info()
{
    global $conn;
    $sql_awards = "SELECT * FROM awards_accolades WHERE deleted = 'no'";
    $res_awards = mysqli_query($conn, $sql_awards);
    if (mysqli_num_rows($res_awards)) {
        return (mysqli_fetch_all($res_awards, MYSQLI_ASSOC));
    } else {
        return null;
    }
}






//  update  award&accolades section information 

function update_awards_info($id, $slug, $title, $post_date, $post_desc, $image)
{
    global $conn;

    // Escape special characters in the title, image, and id variables
    $slug = mysqli_real_escape_string($conn, $slug);
    $title = mysqli_real_escape_string($conn, $title);
    $post_date = mysqli_real_escape_string($conn, $post_date);
    $post_desc = mysqli_real_escape_string($conn, $post_desc);
    $image = mysqli_real_escape_string($conn, $image);
    $id = mysqli_real_escape_string($conn, $id);

    // Construct SQL query
    $sql_awards = "UPDATE awards_accolades SET slug = '$slug', title = '$title', post_date = '$post_date', post_desc = '$post_desc', image = '$image' WHERE id = '$id'";
    // Execute query
    $res_awards = mysqli_query($conn, $sql_awards);
    // Check if query was successful
    if ($res_awards) {
        return true;
    } else {
        return false;
    }
}








//  update  newsdetail section information 

function update_news_details_info_award($id, $image_one, $heading, $description_one, $highlight_desc, $description_two, $image_two, $image_three, $description_three)
{
    global $conn;

    // Escape special characters in the title, image, and id variables

    $image_one = mysqli_real_escape_string($conn, $image_one);
    $heading = mysqli_real_escape_string($conn, $heading);
    $description_one = mysqli_real_escape_string($conn, $description_one);
    $highlight_desc = mysqli_real_escape_string($conn, $highlight_desc);
    $description_two = mysqli_real_escape_string($conn, $description_two);
    $image_two = mysqli_real_escape_string($conn, $image_two);
    $image_three = mysqli_real_escape_string($conn, $image_three);
    $description_three = mysqli_real_escape_string($conn, $description_three);
    $id = mysqli_real_escape_string($conn, $id);

    // Construct SQL query
    $sql_news_details = "UPDATE awards_accolades SET image_one = '$image_one', heading = '$heading',description_one = '$description_one', highlight_desc = '$highlight_desc', description_two = '$description_two',image_two = '$image_two', image_three = '$image_three', description_three = '$description_three' WHERE id = '$id'";
    // Execute query
    $res_news_details = mysqli_query($conn, $sql_news_details);
    // Check if query was successful
    if ($res_news_details) {
        return true;
    } else {
        return false;
    }
}







// function for getting detail information from the database via slug
function get_news_details_info_by_slug($blog_slug)
{
    global $conn;
    $sql_profile = "SELECT * FROM awards_accolades WHERE deleted = 'no' AND slug ='$blog_slug' ";
    $res_profile = mysqli_query($conn, $sql_profile);
    if (mysqli_num_rows($res_profile)) {
        return (mysqli_fetch_all($res_profile, MYSQLI_ASSOC));
    } else {
        return null;
    }
}








//  award&accolades section information by ID
function get_awards_info_by($id)
{

    global $conn;
    $sql_awards = "SELECT * FROM awards_accolades WHERE deleted = 'no' AND id ='$id'";
    $res_awards = mysqli_query($conn, $sql_awards);
    if (mysqli_num_rows($res_awards)) {
        return (mysqli_fetch_all($res_awards, MYSQLI_ASSOC));
    } else {
        return null;
    }
}







//  award&accolades section upload image



function AwardsUploadImage($uploadedImage, $uploadDestination)
{
    // Check if file was uploaded without errors
    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $uploadedImage['tmp_name'];
        // Generate a unique file name to prevent overwriting existing files
        $fileName = uniqid() . '_' . $uploadedImage['name'];
        // Build the target file path
        $targetFilePath = $uploadDestination . '/' . $fileName;

        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully
            return $fileName;
        } else {
            // Error moving the file
            return false;
        }
    } else {
        // Error uploading the file
        return false;
    }
}











//  award&accolades section update image

function AwardsUpdateImage($oldImageLink, $newImage, $destination)
{
    // Check if the new image was uploaded without errors
    if ($newImage['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $newImage['tmp_name'];
        // Generate a unique file name to prevent overwriting existing files
        $fileName = uniqid() . '_' . $newImage['name'];
        // Build the target file path
        $targetFilePath = $destination . '/' . $fileName;
        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully, delete the old image if it exists
            if (file_exists($oldImageLink)) {
                unlink($oldImageLink);
            }
            // Return the new image link
            return $fileName;
        } else {
            // Error moving the file
            return $oldImageLink; // Return the old image link if there was an error
        }
    } else {
        // Error uploading the new image
        return $oldImageLink; // Return the old image link if there was an error
    }
}




// function for  award&accolades section details end !!!

































//  inserting newsdetail section information 



function add_newsdetails_info($news_id, $blog_slug, $image_one, $heading, $description_one, $highlight_desc, $description_two, $image_two, $image_three, $description_three)
{
    global $conn;

    // Escape special characters in the title and image variables
    $news_id = mysqli_real_escape_string($conn, $news_id);
    $blog_slug = mysqli_real_escape_string($conn, $blog_slug);
    $image_one = mysqli_real_escape_string($conn, $image_one);
    $heading = mysqli_real_escape_string($conn, $heading);
    $description_one = mysqli_real_escape_string($conn, $description_one);
    $highlight_desc = mysqli_real_escape_string($conn, $highlight_desc);
    $description_two = mysqli_real_escape_string($conn, $description_two);
    $image_two = mysqli_real_escape_string($conn, $image_two);
    $image_three = mysqli_real_escape_string($conn, $image_three);
    $description_three = mysqli_real_escape_string($conn, $description_three);

    // Construct SQL query
    $sql_news_details = "INSERT INTO news_details (news_id,blog_slug, image_one, heading,description_one,highlight_desc,description_two,image_two,image_three,description_three) VALUES ('$news_id'  ,'$blog_slug' , '$image_one' , '$heading','$description_one'  , '$highlight_desc' , '$description_two','$image_two'  , '$image_three' , '$description_three')";

    // Execute query
    $res_news_details = mysqli_query($conn, $sql_news_details);

    // Check if query was successful
    if ($res_news_details) {
        return true;
    } else {
        return false;
    }
}










//    newsdetail section information 

function get_newsdetails_info()
{
    global $conn;
    $sql_news_details = "SELECT * FROM news_details WHERE deleted = 'no'";
    $res_news_details = mysqli_query($conn, $sql_news_details);
    if (mysqli_num_rows($res_news_details)) {
        return (mysqli_fetch_all($res_news_details, MYSQLI_ASSOC));
    } else {
        return null;
    }
}






//  update  newsdetail section information 

function update_news_details_info($id, $image_one, $heading, $description_one, $highlight_desc, $description_two, $image_two, $image_three, $description_three)
{
    global $conn;

    // Escape special characters in the title, image, and id variables

    $image_one = mysqli_real_escape_string($conn, $image_one);
    $heading = mysqli_real_escape_string($conn, $heading);
    $description_one = mysqli_real_escape_string($conn, $description_one);
    $highlight_desc = mysqli_real_escape_string($conn, $highlight_desc);
    $description_two = mysqli_real_escape_string($conn, $description_two);
    $image_two = mysqli_real_escape_string($conn, $image_two);
    $image_three = mysqli_real_escape_string($conn, $image_three);
    $description_three = mysqli_real_escape_string($conn, $description_three);
    $id = mysqli_real_escape_string($conn, $id);

    // Construct SQL query
    $sql_news_details = "UPDATE news_details SET image_one = '$image_one', heading = '$heading',description_one = '$description_one', highlight_desc = '$highlight_desc', description_two = '$description_two',image_two = '$image_two', image_three = '$image_three', description_three = '$description_three' WHERE id = '$id'";
    // Execute query
    $res_news_details = mysqli_query($conn, $sql_news_details);
    // Check if query was successful
    if ($res_news_details) {
        return true;
    } else {
        return false;
    }
}







//  newsdetail section information by ID
function get_news_details_info_by($id)
{

    global $conn;
    $sql_news_details = "SELECT * FROM news_details WHERE deleted = 'no' AND id ='$id'";
    $res_news_details = mysqli_query($conn, $sql_news_details);
    if (mysqli_num_rows($res_news_details)) {
        return (mysqli_fetch_all($res_news_details, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



// function for getting detail information from the database via ID
function get_details_info_by_newsid($id)
{
    global $conn;
    $sql_profile = "SELECT * FROM news_details WHERE deleted = 'no' AND news_id ='$id' ";
    $res_profile = mysqli_query($conn, $sql_profile);
    if (mysqli_num_rows($res_profile)) {
        return (mysqli_fetch_all($res_profile, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



// function for getting detail information from the database via ID
function get_details_info_by_newslug($blog_slug)
{
    global $conn;
    $sql_profile = "SELECT * FROM news_details WHERE deleted = 'no' AND blog_slug ='$blog_slug' ";
    $res_profile = mysqli_query($conn, $sql_profile);
    if (mysqli_num_rows($res_profile)) {
        return (mysqli_fetch_all($res_profile, MYSQLI_ASSOC));
    } else {
        return null;
    }
}




//  newsdetail section upload image



function NewsDetailsUploadImageOne($uploadedImage, $uploadDestination)
{
    // Check if file was uploaded without errors
    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $uploadedImage['tmp_name'];
        // Generate a unique file name to prevent overwriting existing files
        $fileName = uniqid() . '_' . $uploadedImage['name'];
        // Build the target file path
        $targetFilePath = $uploadDestination . '/' . $fileName;

        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully
            return $fileName;
        } else {
            // Error moving the file
            return false;
        }
    } else {
        // Error uploading the file
        return false;
    }
}





function NewsDetailsUploadImageTwo($uploadedImage, $uploadDestination)
{
    // Check if file was uploaded without errors
    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $uploadedImage['tmp_name'];
        // Generate a unique file name to prevent overwriting existing files
        $fileName = uniqid() . '_' . $uploadedImage['name'];
        // Build the target file path
        $targetFilePath = $uploadDestination . '/' . $fileName;

        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully
            return $fileName;
        } else {
            // Error moving the file
            return false;
        }
    } else {
        // Error uploading the file
        return false;
    }
}



function NewsDetailsUploadImageThree($uploadedImage, $uploadDestination)
{
    // Check if file was uploaded without errors
    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $uploadedImage['tmp_name'];
        // Generate a unique file name to prevent overwriting existing files
        $fileName = uniqid() . '_' . $uploadedImage['name'];
        // Build the target file path
        $targetFilePath = $uploadDestination . '/' . $fileName;

        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully
            return $fileName;
        } else {
            // Error moving the file
            return false;
        }
    } else {
        // Error uploading the file
        return false;
    }
}








//  newsdetails section update image

function NewsDetailsUpdateImageOne($oldImageLink, $newImage, $destination)
{
    // Check if the new image was uploaded without errors
    if ($newImage['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $newImage['tmp_name'];
        // Generate a unique file name to prevent overwriting existing files
        $fileName = uniqid() . '_' . $newImage['name'];
        // Build the target file path
        $targetFilePath = $destination . '/' . $fileName;
        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully, delete the old image if it exists
            if (file_exists($oldImageLink)) {
                unlink($oldImageLink);
            }
            // Return the new image link
            return $fileName;
        } else {
            // Error moving the file
            return $oldImageLink; // Return the old image link if there was an error
        }
    } else {
        // Error uploading the new image
        return $oldImageLink; // Return the old image link if there was an error
    }
}



function NewsDetailsUpdateImageTwo($oldImageLink, $newImage, $destination)
{
    // Check if the new image was uploaded without errors
    if ($newImage['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $newImage['tmp_name'];
        // Generate a unique file name to prevent overwriting existing files
        $fileName = uniqid() . '_' . $newImage['name'];
        // Build the target file path
        $targetFilePath = $destination . '/' . $fileName;
        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully, delete the old image if it exists
            if (file_exists($oldImageLink)) {
                unlink($oldImageLink);
            }
            // Return the new image link
            return $fileName;
        } else {
            // Error moving the file
            return $oldImageLink; // Return the old image link if there was an error
        }
    } else {
        // Error uploading the new image
        return $oldImageLink; // Return the old image link if there was an error
    }
}




function NewsDetailsUpdateImageThree($oldImageLink, $newImage, $destination)
{
    // Check if the new image was uploaded without errors
    if ($newImage['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $newImage['tmp_name'];
        // Generate a unique file name to prevent overwriting existing files
        $fileName = uniqid() . '_' . $newImage['name'];
        // Build the target file path
        $targetFilePath = $destination . '/' . $fileName;
        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully, delete the old image if it exists
            if (file_exists($oldImageLink)) {
                unlink($oldImageLink);
            }
            // Return the new image link
            return $fileName;
        } else {
            // Error moving the file
            return $oldImageLink; // Return the old image link if there was an error
        }
    } else {
        // Error uploading the new image
        return $oldImageLink; // Return the old image link if there was an error
    }
}




// function for  newsdetail section details end !!!









//  inserting for blog  section information 



function add_blogs_info($slug, $title, $post_date, $post_desc, $category, $image)
{
    global $conn;

    // Escape special characters in the title and image variables
    $slug = mysqli_real_escape_string($conn, $slug);
    $title = mysqli_real_escape_string($conn, $title);
    $post_date = mysqli_real_escape_string($conn, $post_date);
    $post_desc = mysqli_real_escape_string($conn, $post_desc);
    $category = mysqli_real_escape_string($conn, $category);
    $image = mysqli_real_escape_string($conn, $image);

    // Construct SQL query
    $sql_awards = "INSERT INTO blogs (slug,title, post_date,post_desc, category, image) VALUES ('$slug'  ,'$title'  , '$post_date' , '$post_desc' , '$category', '$image')";

    // Execute query
    $res_awards = mysqli_query($conn, $sql_awards);

    // Check if query was successful
    if ($res_awards) {
        return true;
    } else {
        return false;
    }
}



//  inserting for blog category section information 



function add_blogs_cat_info($name)
{
    global $conn;

    // Escape special characters in the title and image variables
    $name = mysqli_real_escape_string($conn, $name);


    // Construct SQL query
    $sql_bl_cat = "INSERT INTO blogs_category (name) VALUES ('$name')";

    // Execute query
    $res_bl_cat = mysqli_query($conn, $sql_bl_cat);

    // Check if query was successful
    if ($res_bl_cat) {
        return true;
    } else {
        return false;
    }
}


function bmw_report($bmw_year, $bmw_month, $image)
{
    global $conn;

    // Escape special characters in the title and image variables
    $slug = mysqli_real_escape_string($conn, $bmw_year);
    $title = mysqli_real_escape_string($conn, $bmw_month);
    $image = mysqli_real_escape_string($conn, $image);

    // Construct SQL query
    $sql_bmwreport = "INSERT INTO bmw_report (bmw_year,bmw_month,image) VALUES ('$bmw_year', '$bmw_month', '$image')";

    // Execute query
    $res_bmwreport = mysqli_query($conn, $sql_bmwreport);

    // Check if query was successful
    if ($res_bmwreport) {
        return true;
    } else {
        return false;
    }
}


function bmw_report_info()
{
    global $conn;
    $sql_bmw_report = "SELECT * FROM bmw_report WHERE deleted = 'no'";
    $res_bmw_report = mysqli_query($conn, $sql_bmw_report);
    if (mysqli_num_rows($res_bmw_report)) {
        return (mysqli_fetch_all($res_bmw_report, MYSQLI_ASSOC));
    } else {
        return null;
    }
}


function bmw_year($year_name)
{
    global $conn;

    // Escape special characters in the title and image variables

    $title = mysqli_real_escape_string($conn, $year_name);

    // Construct SQL query
    $sql_bmw_year = "INSERT INTO bmw_year (year_name) VALUES ('$year_name')";

    // Execute query
    $res_bmw_year = mysqli_query($conn, $sql_bmw_year);

    // Check if query was successful
    if ($res_bmw_year) {
        return true;
    } else {
        return false;
    }
}


function bmw_year_info()
{
    global $conn;
    $sql_bmw_year = "SELECT * FROM bmw_year WHERE deleted = 'no'";
    $res_bmw_year = mysqli_query($conn, $sql_bmw_year);
    if (mysqli_num_rows($res_bmw_year)) {
        return (mysqli_fetch_all($res_bmw_year, MYSQLI_ASSOC));
    } else {
        return null;
    }
}




function bmwReportpdf($uploadedImage, $uploadDestination)
{
    // Check if file was uploaded without errors
    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $uploadedImage['tmp_name'];
        // Generate a unique file name to prevent overwriting existing files
        $fileName = uniqid() . '_' . $uploadedImage['name'];
        // Build the target file path
        $targetFilePath = $uploadDestination . '/' . $fileName;

        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully
            return $fileName;
        } else {
            // Error moving the file
            return false;
        }
    } else {
        // Error uploading the file
        return false;
    }
}






//    blog section information 

function get_blogs_info()
{
    global $conn;
    $sql_awards = "SELECT * FROM blogs WHERE deleted = 'no'";
    $res_awards = mysqli_query($conn, $sql_awards);
    if (mysqli_num_rows($res_awards)) {
        return (mysqli_fetch_all($res_awards, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



//    blog category section information 

function get_blogs_cat_info()
{
    global $conn;
    $sql_blog_cat = "SELECT * FROM blogs_category WHERE deleted = 'no'";
    $res_blog_cat = mysqli_query($conn, $sql_blog_cat);
    if (mysqli_num_rows($res_blog_cat)) {
        return (mysqli_fetch_all($res_blog_cat, MYSQLI_ASSOC));
    } else {
        return null;
    }
}







//  update  blog section information 

function update_blogs_info($id, $slug, $title, $post_date, $post_desc, $category, $image)
{
    global $conn;

    // Escape special characters in the title, image, and id variables
    $slug = mysqli_real_escape_string($conn, $slug);
    $title = mysqli_real_escape_string($conn, $title);
    $post_date = mysqli_real_escape_string($conn, $post_date);
    $post_desc = mysqli_real_escape_string($conn, $post_desc);
    $category = mysqli_real_escape_string($conn, $category);
    $image = mysqli_real_escape_string($conn, $image);
    $id = mysqli_real_escape_string($conn, $id);

    // Construct SQL query
    $sql_awards = "UPDATE blogs SET slug = '$slug', title = '$title', post_date = '$post_date', post_desc = '$post_desc', category = '$category', image = '$image' WHERE id = '$id'";
    // Execute query
    $res_awards = mysqli_query($conn, $sql_awards);
    // Check if query was successful
    if ($res_awards) {
        return true;
    } else {
        return false;
    }
}



//  update  blog category section information 

function update_blogs_cat_info($id, $name)
{
    global $conn;

    // Escape special characters in the title, image, and id variables
    $name = mysqli_real_escape_string($conn, $name);
    $id = mysqli_real_escape_string($conn, $id);

    // Construct SQL query
    $sql_bl_cat = "UPDATE blogs_category SET name = '$name' WHERE id = '$id'";
    // Execute query
    $res_bl_cat = mysqli_query($conn, $sql_bl_cat);
    // Check if query was successful
    if ($res_bl_cat) {
        return true;
    } else {
        return false;
    }
}




//  update  blogdetail section information 

function update_blogdetails_info($id, $image_one, $heading, $description_one, $highlight_desc, $description_two, $image_two, $image_three, $description_three)
{
    global $conn;

    // Escape special characters in the title, image, and id variables

    $image_one = mysqli_real_escape_string($conn, $image_one);
    $heading = mysqli_real_escape_string($conn, $heading);
    $description_one = mysqli_real_escape_string($conn, $description_one);
    $highlight_desc = mysqli_real_escape_string($conn, $highlight_desc);
    $description_two = mysqli_real_escape_string($conn, $description_two);
    $image_two = mysqli_real_escape_string($conn, $image_two);
    $image_three = mysqli_real_escape_string($conn, $image_three);
    $description_three = mysqli_real_escape_string($conn, $description_three);
    $id = mysqli_real_escape_string($conn, $id);

    // Construct SQL query
    $sql_news_details = "UPDATE blogs SET image_one = '$image_one', heading = '$heading',description_one = '$description_one', highlight_desc = '$highlight_desc', description_two = '$description_two',image_two = '$image_two', image_three = '$image_three', description_three = '$description_three' WHERE id = '$id'";
    // Execute query
    $res_news_details = mysqli_query($conn, $sql_news_details);
    // Check if query was successful
    if ($res_news_details) {
        return true;
    } else {
        return false;
    }
}





// function for getting detail information from the database via slug
function get_details_info_by_blog($blog_slug)
{
    global $conn;
    $sql_profile = "SELECT * FROM blogs WHERE deleted = 'no' AND slug ='$blog_slug' ";
    $res_profile = mysqli_query($conn, $sql_profile);
    if (mysqli_num_rows($res_profile)) {
        return (mysqli_fetch_all($res_profile, MYSQLI_ASSOC));
    } else {
        return null;
    }
}




//  blog section information by ID
function get_blogs_info_by($id)
{

    global $conn;
    $sql_awards = "SELECT * FROM blogs WHERE deleted = 'no' AND id ='$id'";
    $res_awards = mysqli_query($conn, $sql_awards);
    if (mysqli_num_rows($res_awards)) {
        return (mysqli_fetch_all($res_awards, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



//  blog category section information by ID
function get_blogs_cat_info_by($id)
{

    global $conn;
    $sql_category = "SELECT * FROM blogs_category WHERE deleted = 'no' AND id ='$id'";
    $res_category = mysqli_query($conn, $sql_category);
    if (mysqli_num_rows($res_category)) {
        return (mysqli_fetch_all($res_category, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



function get_blogs_info_limit_desc()

{
    global $conn;
    $sql_blogs = "SELECT * FROM blogs WHERE deleted = 'no'  ORDER BY id DESC LIMIT 3";
    $res_blogs = mysqli_query($conn, $sql_blogs);
    if (mysqli_num_rows($res_blogs)) {
        return (mysqli_fetch_all($res_blogs, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



//  blog section upload image



function BlogsUploadImage($uploadedImage, $uploadDestination)
{
    // Check if file was uploaded without errors
    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $uploadedImage['tmp_name'];
        // Generate a unique file name to prevent overwriting existing files
        $fileName = uniqid() . '_' . $uploadedImage['name'];
        // Build the target file path
        $targetFilePath = $uploadDestination . '/' . $fileName;

        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully
            return $fileName;
        } else {
            // Error moving the file
            return false;
        }
    } else {
        // Error uploading the file
        return false;
    }
}











//  blog section update image

function BlogsUpdateImage($oldImageLink, $newImage, $destination)
{
    // Check if the new image was uploaded without errors
    if ($newImage['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $newImage['tmp_name'];
        // Generate a unique file name to prevent overwriting existing files
        $fileName = uniqid() . '_' . $newImage['name'];
        // Build the target file path
        $targetFilePath = $destination . '/' . $fileName;
        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully, delete the old image if it exists
            if (file_exists($oldImageLink)) {
                unlink($oldImageLink);
            }
            // Return the new image link
            return $fileName;
        } else {
            // Error moving the file
            return $oldImageLink; // Return the old image link if there was an error
        }
    } else {
        // Error uploading the new image
        return $oldImageLink; // Return the old image link if there was an error
    }
}




// function for  blog section details end !!!

































//  inserting blogdetail section information 



function add_blogdetail_info($blog_id, $blog_slug, $image_one, $heading, $description_one, $highlight_desc, $description_two, $image_two, $image_three, $description_three)
{
    global $conn;

    // Escape special characters in the title and image variables
    $blog_id = mysqli_real_escape_string($conn, $blog_id);
    $blog_slug = mysqli_real_escape_string($conn, $blog_slug);
    $image_one = mysqli_real_escape_string($conn, $image_one);
    $heading = mysqli_real_escape_string($conn, $heading);
    $description_one = mysqli_real_escape_string($conn, $description_one);
    $highlight_desc = mysqli_real_escape_string($conn, $highlight_desc);
    $description_two = mysqli_real_escape_string($conn, $description_two);
    $image_two = mysqli_real_escape_string($conn, $image_two);
    $image_three = mysqli_real_escape_string($conn, $image_three);
    $description_three = mysqli_real_escape_string($conn, $description_three);

    // Construct SQL query
    $sql_news_details = "INSERT INTO blogdetail (blog_id,blog_slug, image_one, heading,description_one,highlight_desc,description_two,image_two,image_three,description_three) VALUES ('$blog_id'  ,'$blog_slug' , '$image_one' , '$heading','$description_one'  , '$highlight_desc' , '$description_two','$image_two'  , '$image_three' , '$description_three')";

    // Execute query
    $res_news_details = mysqli_query($conn, $sql_news_details);

    // Check if query was successful
    if ($res_news_details) {
        return true;
    } else {
        return false;
    }
}










//    blogdetail section information 

function get_blogdetail_info()
{
    global $conn;
    $sql_news_details = "SELECT * FROM blogdetail WHERE deleted = 'no'";
    $res_news_details = mysqli_query($conn, $sql_news_details);
    if (mysqli_num_rows($res_news_details)) {
        return (mysqli_fetch_all($res_news_details, MYSQLI_ASSOC));
    } else {
        return null;
    }
}






//  update  blogdetail section information 

function update_blogdetail_info($id, $image_one, $heading, $description_one, $highlight_desc, $description_two, $image_two, $image_three, $description_three)
{
    global $conn;

    // Escape special characters in the title, image, and id variables

    $image_one = mysqli_real_escape_string($conn, $image_one);
    $heading = mysqli_real_escape_string($conn, $heading);
    $description_one = mysqli_real_escape_string($conn, $description_one);
    $highlight_desc = mysqli_real_escape_string($conn, $highlight_desc);
    $description_two = mysqli_real_escape_string($conn, $description_two);
    $image_two = mysqli_real_escape_string($conn, $image_two);
    $image_three = mysqli_real_escape_string($conn, $image_three);
    $description_three = mysqli_real_escape_string($conn, $description_three);
    $id = mysqli_real_escape_string($conn, $id);

    // Construct SQL query
    $sql_news_details = "UPDATE blogdetail SET image_one = '$image_one', heading = '$heading',description_one = '$description_one', highlight_desc = '$highlight_desc', description_two = '$description_two',image_two = '$image_two', image_three = '$image_three', description_three = '$description_three' WHERE id = '$id'";
    // Execute query
    $res_news_details = mysqli_query($conn, $sql_news_details);
    // Check if query was successful
    if ($res_news_details) {
        return true;
    } else {
        return false;
    }
}







//  blogdetail section information by ID
function get_blogdetail_info_by($id)
{

    global $conn;
    $sql_news_details = "SELECT * FROM blogdetail WHERE deleted = 'no' AND id ='$id'";
    $res_news_details = mysqli_query($conn, $sql_news_details);
    if (mysqli_num_rows($res_news_details)) {
        return (mysqli_fetch_all($res_news_details, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



// function for getting detail information from the database via ID
function get_details_info_by_blogdid($id)
{
    global $conn;
    $sql_profile = "SELECT * FROM blogdetail WHERE deleted = 'no' AND blog_id ='$id' ";
    $res_profile = mysqli_query($conn, $sql_profile);
    if (mysqli_num_rows($res_profile)) {
        return (mysqli_fetch_all($res_profile, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



// function for getting detail information from the database via ID
function get_details_info_by_bloglug($blog_slug)
{
    global $conn;
    $sql_profile = "SELECT * FROM blogdetail WHERE deleted = 'no' AND blog_slug ='$blog_slug' ";
    $res_profile = mysqli_query($conn, $sql_profile);
    if (mysqli_num_rows($res_profile)) {
        return (mysqli_fetch_all($res_profile, MYSQLI_ASSOC));
    } else {
        return null;
    }
}




//  blogdetail section upload image



function BlogDetailsUploadImageOne($uploadedImage, $uploadDestination)
{
    // Check if file was uploaded without errors
    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $uploadedImage['tmp_name'];
        // Generate a unique file name to prevent overwriting existing files
        $fileName = uniqid() . '_' . $uploadedImage['name'];
        // Build the target file path
        $targetFilePath = $uploadDestination . '/' . $fileName;

        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully
            return $fileName;
        } else {
            // Error moving the file
            return false;
        }
    } else {
        // Error uploading the file
        return false;
    }
}





function BlogDetailsUploadImageTwo($uploadedImage, $uploadDestination)
{
    // Check if file was uploaded without errors
    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $uploadedImage['tmp_name'];
        // Generate a unique file name to prevent overwriting existing files
        $fileName = uniqid() . '_' . $uploadedImage['name'];
        // Build the target file path
        $targetFilePath = $uploadDestination . '/' . $fileName;

        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully
            return $fileName;
        } else {
            // Error moving the file
            return false;
        }
    } else {
        // Error uploading the file
        return false;
    }
}



function BlogDetailsUploadImageThree($uploadedImage, $uploadDestination)
{
    // Check if file was uploaded without errors
    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $uploadedImage['tmp_name'];
        // Generate a unique file name to prevent overwriting existing files
        $fileName = uniqid() . '_' . $uploadedImage['name'];
        // Build the target file path
        $targetFilePath = $uploadDestination . '/' . $fileName;

        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully
            return $fileName;
        } else {
            // Error moving the file
            return false;
        }
    } else {
        // Error uploading the file
        return false;
    }
}








//  blogdetail section update image

function BlogDetailsUpdateImageOne($oldImageLink, $newImage, $destination)
{
    // Check if the new image was uploaded without errors
    if ($newImage['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $newImage['tmp_name'];
        // Generate a unique file name to prevent overwriting existing files
        $fileName = uniqid() . '_' . $newImage['name'];
        // Build the target file path
        $targetFilePath = $destination . '/' . $fileName;
        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully, delete the old image if it exists
            if (file_exists($oldImageLink)) {
                unlink($oldImageLink);
            }
            // Return the new image link
            return $fileName;
        } else {
            // Error moving the file
            return $oldImageLink; // Return the old image link if there was an error
        }
    } else {
        // Error uploading the new image
        return $oldImageLink; // Return the old image link if there was an error
    }
}



function BlogDetailsUpdateImageTwo($oldImageLink, $newImage, $destination)
{
    // Check if the new image was uploaded without errors
    if ($newImage['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $newImage['tmp_name'];
        // Generate a unique file name to prevent overwriting existing files
        $fileName = uniqid() . '_' . $newImage['name'];
        // Build the target file path
        $targetFilePath = $destination . '/' . $fileName;
        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully, delete the old image if it exists
            if (file_exists($oldImageLink)) {
                unlink($oldImageLink);
            }
            // Return the new image link
            return $fileName;
        } else {
            // Error moving the file
            return $oldImageLink; // Return the old image link if there was an error
        }
    } else {
        // Error uploading the new image
        return $oldImageLink; // Return the old image link if there was an error
    }
}




function BlogDetailsUpdateImageThree($oldImageLink, $newImage, $destination)
{
    // Check if the new image was uploaded without errors
    if ($newImage['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $newImage['tmp_name'];
        // Generate a unique file name to prevent overwriting existing files
        $fileName = uniqid() . '_' . $newImage['name'];
        // Build the target file path
        $targetFilePath = $destination . '/' . $fileName;
        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully, delete the old image if it exists
            if (file_exists($oldImageLink)) {
                unlink($oldImageLink);
            }
            // Return the new image link
            return $fileName;
        } else {
            // Error moving the file
            return $oldImageLink; // Return the old image link if there was an error
        }
    } else {
        // Error uploading the new image
        return $oldImageLink; // Return the old image link if there was an error
    }
}




// function for  blogdetail section details end !!!




//  inserting gallery section information 





function add_gallery_info($image)

{

    global $conn;

    $sql_gallery = "INSERT INTO gallery (image)

                   Values('$image')";

    $res_gallery = mysqli_query($conn, $sql_gallery);



    if ($res_gallery) {

        return True;
    } else {

        return False;
    }
}







//    gallery section information 

function get_gallery_info()

{





    global $conn;



    $sql_gallery = "SELECT * FROM gallery WHERE deleted = 'no'";



    $res_gallery = mysqli_query($conn, $sql_gallery);



    if (mysqli_num_rows($res_gallery)) {

        return (mysqli_fetch_all($res_gallery, MYSQLI_ASSOC));
    } else {

        return null;
    }
}









//  update  gallery section information 



function update_gallery_info($id, $image)

{

    global $conn;



    $sql_gallery = "UPDATE gallery SET image='$image' where id = '$id';";

    $res_gallery = mysqli_query($conn, $sql_gallery);





    if ($res_gallery) {

        return True;
    } else {

        return False;
    }
}







//  gallery section information by ID



function get_gallery_info_by($id)

{





    global $conn;



    $sql_gallery = "SELECT * FROM gallery WHERE deleted = 'no' AND id ='$id'";



    $res_gallery = mysqli_query($conn, $sql_gallery);



    if (mysqli_num_rows($res_gallery)) {

        return (mysqli_fetch_all($res_gallery, MYSQLI_ASSOC));
    } else {

        return null;
    }
}







//  gallery section upload image



function GalleryUploadImage($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}











// gallery section update image





function GalleryUpdateImage($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}









// function for  gallery section details end !!!































//  inserting careers information 





function add_careers_info($name, $number, $email, $file, $career_id, $career_slug)

{

    global $conn;

    $sql_careers = "INSERT INTO careers_query (name,number,email,file,career_id,career_slug)

                   Values('$name','$number','$email','$file','$career_id','$career_slug')";

    $res_careers = mysqli_query($conn, $sql_careers);



    if ($res_careers) {

        return True;
    } else {

        return False;
    }
}







//  careers information 







function get_careers_info()

{





    global $conn;



    $sql_careers = "SELECT * FROM careers_query WHERE deleted = 'no' ";



    $res_careers = mysqli_query($conn, $sql_careers);



    if (mysqli_num_rows($res_careers)) {

        return (mysqli_fetch_all($res_careers, MYSQLI_ASSOC));
    } else {

        return null;
    }
}











//  careers information 







function get_careers_info_id($id)

{





    global $conn;



    $sql_careers = "SELECT * FROM careers_query WHERE id='$id' AND deleted = 'no' ";



    $res_careers = mysqli_query($conn, $sql_careers);



    if (mysqli_num_rows($res_careers)) {

        return (mysqli_fetch_all($res_careers, MYSQLI_ASSOC));
    } else {

        return null;
    }
}







//  pdf section upload image



function uploadFile($uploadedFile, $uploadDestination)
{
    // Check if file was uploaded without errors
    if ($uploadedFile['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $uploadedFile['tmp_name'];

        // Generate a unique file name to prevent overwriting existing files
        $fileName = uniqid() . '_' . $uploadedFile['name'];

        // Build the target file path
        $targetFilePath = $uploadDestination . '/' . $fileName;

        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully
            return $fileName;
        } else {
            // Error moving the file
            return false;
        }
    } else {
        // Error uploading the file
        return false;
    }
}







function uploadDocument($fileInputName, $uploadDirectory)
{
    $targetFile = $uploadDirectory . basename($_FILES[$fileInputName]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Allow all file formats
    // You might want to implement additional checks for security
    // such as validating the file type against a whitelist
    // or checking file size
    $uploadOk = 1;

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // if everything is ok, try to upload file
        if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $targetFile)) {
            echo "The file " . basename($_FILES[$fileInputName]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
















function uploadPdfFile($uploadedFile, $uploadDestination, $allowedFormats)
{
    // Check if file was uploaded without errors
    if ($uploadedFile['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $uploadedFile['tmp_name'];

        // Check the file type
        $fileType = mime_content_type($tmpFilePath);

        // Check if the file type is allowed
        if (!in_array($fileType, $allowedFormats)) {
            // Invalid file type, handle accordingly (you may want to provide an error message)
            return false;
        }

        // Get the original file name
        $originalFileName = $uploadedFile['name'];

        // Build the target file path
        $targetFilePath = $uploadDestination . '/' . $originalFileName;

        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully
            return $originalFileName;
        } else {
            // Error moving the file
            return false;
        }
    } else {
        // Error uploading the file
        return false;
    }
}











function get_careers_info_desc()

{





    global $conn;



    $sql_careers = "SELECT * FROM careers_query WHERE deleted = 'no' ORDER BY id DESC";



    $res_careers = mysqli_query($conn, $sql_careers);



    if (mysqli_num_rows($res_careers)) {

        return (mysqli_fetch_all($res_careers, MYSQLI_ASSOC));
    } else {

        return null;
    }
}



// function for career end !!!



































//  inserting health package information 





function add_hpackage_info($name, $email, $number, $age, $package, $package_slug, $date)

{

    global $conn;

    $sql_queries = "INSERT INTO hpackage_query (name,email, number,age, package,package_slug,date)

                   Values('$name', '$email','$number','$age','$package','$package_slug','$date')";

    $res_queries = mysqli_query($conn, $sql_queries);



    if ($res_queries) {

        return True;
    } else {

        return False;
    }
}







//  health package information 







function get_hpackage_info()

{





    global $conn;



    $sql_hpackage_query = "SELECT * FROM hpackage_query WHERE deleted = 'no' ";



    $res_hpackage_query = mysqli_query($conn, $sql_hpackage_query);



    if (mysqli_num_rows($res_hpackage_query)) {

        return (mysqli_fetch_all($res_hpackage_query, MYSQLI_ASSOC));
    } else {

        return null;
    }
}













function get_hpackage_info_by_package($id)

{





    global $conn;



    $sql_hpackage_query = "SELECT * FROM hpackage_query WHERE deleted = 'no' AND package='$id' ";



    $res_hpackage_query = mysqli_query($conn, $sql_hpackage_query);



    if (mysqli_num_rows($res_hpackage_query)) {

        return (mysqli_fetch_all($res_hpackage_query, MYSQLI_ASSOC));
    } else {

        return null;
    }
}











function get_hpackage_info_desc()

{





    global $conn;



    $sql_hpackage_query = "SELECT * FROM hpackage_query WHERE deleted = 'no'  ORDER BY id DESC";



    $res_hpackage_query = mysqli_query($conn, $sql_hpackage_query);



    if (mysqli_num_rows($res_hpackage_query)) {

        return (mysqli_fetch_all($res_hpackage_query, MYSQLI_ASSOC));
    } else {

        return null;
    }
}









// function for health package end !!!



























// department type information from the database

function get_departmenttype_info()
{
    global $conn;

    $sql_department = "SELECT * FROM department_type WHERE deleted = 'no'";

    $res_department = mysqli_query($conn, $sql_department);

    if (mysqli_num_rows($res_department)) {

        return (mysqli_fetch_all($res_department, MYSQLI_ASSOC));
    } else {

        return null;
    }
}

function get_departmenttype_info_by_type($type)
{
    global $conn;

    $sql_department = "SELECT * FROM all_department WHERE type='$type' and deleted = 'no'";

    $res_department = mysqli_query($conn, $sql_department);

    if (mysqli_num_rows($res_department)) {

        return (mysqli_fetch_all($res_department, MYSQLI_ASSOC));
    } else {

        return null;
    }
}

function get_details_specialities_by_id($id)
{



    global $conn;

    $sql_depart_details = "SELECT * FROM all_department WHERE deleted = 'no' AND id ='$id' ";

    $res_depart_details = mysqli_query($conn, $sql_depart_details);

    if (mysqli_num_rows($res_depart_details)) {
        return (mysqli_fetch_assoc($res_depart_details));
    } else {
        return null;
    }
}













// function for department started.....











//  inserting department information into the database





function add_department_info($slug, $image, $dept_logo, $name, $dept_type, $dept_id, $short_desc, $banner_image, $meta_keyword, $meta_description, $meta_title)
{
    global $conn;



    // Escape special characters in variables
    $slug = mysqli_real_escape_string($conn, $slug);
    $image = mysqli_real_escape_string($conn, $image);
    $dept_logo = mysqli_real_escape_string($conn, $dept_logo);
    $name = mysqli_real_escape_string($conn, $name);
    $dept_type = mysqli_real_escape_string($conn, $dept_type);
    $dept_id = mysqli_real_escape_string($conn, $dept_id);
    $short_desc = mysqli_real_escape_string($conn, $short_desc);
    $banner_image = mysqli_real_escape_string($conn, $banner_image);
    $meta_keyword = mysqli_real_escape_string($conn, $meta_keyword);
    $meta_description = mysqli_real_escape_string($conn, $meta_description);
    $meta_title = mysqli_real_escape_string($conn, $meta_title);

    // Construct SQL query
    $sql_department = "INSERT INTO department (slug, image, dept_logo, name, dept_type, dept_id, short_desc, banner_image, meta_keyword, meta_description, meta_title)
                   VALUES ('$slug', '$image', '$dept_logo', '$name', '$dept_type', '$dept_id', '$short_desc', '$banner_image', '$meta_keyword', '$meta_description', '$meta_title')";

    // Execute query
    $res_department = mysqli_query($conn, $sql_department);

    // Check if query was successful
    if ($res_department) {
        return true;
    } else {
        // Log or display error message
        return false;
    }
}








// department information from the database

function get_department_info()

{





    global $conn;



    $sql_department = "SELECT * FROM department WHERE deleted = 'no'";



    $res_department = mysqli_query($conn, $sql_department);



    if (mysqli_num_rows($res_department)) {

        return (mysqli_fetch_all($res_department, MYSQLI_ASSOC));
    } else {

        return null;
    }
}

function get_department_info_by_dept_id($dept_type)

{


    global $conn;



    $sql_department = "SELECT * FROM department WHERE dept_type = '$dept_type' and deleted = 'no'";



    $res_department = mysqli_query($conn, $sql_department);



    if (mysqli_num_rows($res_department)) {

        return (mysqli_fetch_all($res_department, MYSQLI_ASSOC));
    } else {

        return null;
    }
}





//  update department information into the database



function update_department_info($id, $slug, $image, $dept_logo, $name, $dept_type, $short_desc, $banner_image, $meta_keyword, $meta_description, $meta_title)
{
    global $conn;

    // Prepare the SQL statement
    $sql_department = "UPDATE department SET slug = ?, image = ?, dept_logo = ?, name = ?, dept_type = ?, short_desc = ?, banner_image = ?, meta_keyword = ?, meta_description = ?, meta_title = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql_department);

    // Check for errors in preparing the statement
    if (!$stmt) {
        return false;
    }

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssssssssssi", $slug, $image, $dept_logo, $name, $dept_type, $short_desc, $banner_image, $meta_keyword, $meta_description, $meta_title, $id);

    // Execute the statement
    $res_department = mysqli_stmt_execute($stmt);

    if ($res_department) {
        return true;
    } else {
        return false;
    }
}








// function for getting department information from the database via ID



function get_department_info_by($id)

{





    global $conn;



    $sql_department = "SELECT * FROM department WHERE deleted = 'no' AND id ='$id'";



    $res_department = mysqli_query($conn, $sql_department);

    // $depart=mysqli_fetch_assoc($res_department);

    if (mysqli_num_rows($res_department)) {

        return (mysqli_fetch_assoc($res_department));
    } else {

        return null;
    }
}






// function for getting department information for doctor from the database via ID



function get_department_info_for_doctor_by($id)

{





    global $conn;



    $sql_department = "SELECT * FROM all_department WHERE deleted = 'no' AND id ='$id'";



    $res_department = mysqli_query($conn, $sql_department);

    // $depart=mysqli_fetch_assoc($res_department);

    if (mysqli_num_rows($res_department)) {

        return (mysqli_fetch_assoc($res_department));
    } else {

        return null;
    }
}





// function for getting department information for doctor from the database via ID



function get_department_info_for_doctor_by_slug($slug)

{





    global $conn;



    $sql_department = "SELECT * FROM all_department WHERE deleted = 'no' AND slug ='$slug'";



    $res_department = mysqli_query($conn, $sql_department);

    // $depart=mysqli_fetch_assoc($res_department);

    if (mysqli_num_rows($res_department)) {

        return (mysqli_fetch_assoc($res_department));
    } else {

        return null;
    }
}








// function for getting department type information from the database via ID



function get_departmenttype_info_by($id)

{





    global $conn;



    $sql_department_type = "SELECT * FROM department_type WHERE deleted = 'no' AND id ='$id'";



    $res_department_type = mysqli_query($conn, $sql_department_type);



    if (mysqli_num_rows($res_department_type)) {

        return (mysqli_fetch_assoc($res_department_type));
    } else {

        return null;
    }
}







// department information by slug from the database

function get_department_info_slug($department_slug)

{





    global $conn;



    $sql_department = "SELECT * FROM department WHERE  slug = '$department_slug' and deleted = 'no'";



    $res_department = mysqli_query($conn, $sql_department);



    if (mysqli_num_rows($res_department)) {

        return (mysqli_fetch_all($res_department, MYSQLI_ASSOC));
    } else {

        return null;
    }
}







function get_department_info_coe()

{





    global $conn;



    $sql_department = "SELECT * FROM department WHERE  dept_type='1' AND deleted = 'no' ";



    $res_department = mysqli_query($conn, $sql_department);



    if (mysqli_num_rows($res_department)) {

        return (mysqli_fetch_all($res_department, MYSQLI_ASSOC));
    } else {

        return null;
    }
}







function get_department_info_coe_rand()

{





    global $conn;







    $sql_department = "SELECT * FROM department WHERE  dept_type='1' AND deleted = 'no' ORDER BY RAND() LIMIT 6  ";



    $res_department = mysqli_query($conn, $sql_department);



    if (mysqli_num_rows($res_department)) {

        return (mysqli_fetch_all($res_department, MYSQLI_ASSOC));
    } else {

        return null;
    }
}









function get_department_info_specialities()

{





    global $conn;



    $sql_department = "SELECT * FROM department WHERE  dept_type='2' AND deleted = 'no'";



    $res_department = mysqli_query($conn, $sql_department);



    if (mysqli_num_rows($res_department)) {

        return (mysqli_fetch_all($res_department, MYSQLI_ASSOC));
    } else {

        return null;
    }
}

function get_department_info_specialities2()

{





    global $conn;



    $sql_department = "SELECT * FROM department WHERE   deleted = 'no'";



    $res_department = mysqli_query($conn, $sql_department);



    if (mysqli_num_rows($res_department)) {

        return (mysqli_fetch_all($res_department, MYSQLI_ASSOC));
    } else {

        return null;
    }
}





function DepartmentUploadImage($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}















function DepartmentUpdateImage($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}

























function DepartmentlogoUploadImage($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}















function DepartmentlogoUpdateImage($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}















function DepartmentbannerUploadImage($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}















function DepartmentbannerUpdateImage($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}





















// Functions for department details





// function for getting department details information from the database

function get_departmentdetails_info()

{





    global $conn;



    $sql_depart_details = "SELECT * FROM department_details WHERE deleted = 'no'";



    $res_depart_details = mysqli_query($conn, $sql_depart_details);



    if (mysqli_num_rows($res_depart_details)) {

        return (mysqli_fetch_all($res_depart_details, MYSQLI_ASSOC));
    } else {

        return null;
    }
}





// function for inserting profile information into the database





function add_departmentdetails_info($header_title, $title, $description, $department_id)
{
    global $conn;

    $sql_depart_details = "INSERT INTO department_details 
                           (header_title, title, description, department_id) 
                           VALUES (?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql_depart_details);

    mysqli_stmt_bind_param($stmt, "sssi", $header_title, $title, $description, $department_id);

    $res_depart_details = mysqli_stmt_execute($stmt);

    if (!$res_depart_details) {
        echo "SQL Error: " . mysqli_stmt_error($stmt);
    }

    return $res_depart_details ? true : false;
}






// function for update profile information into the database



function update_departmentdetails_info($id, $header_title, $title, $description)
{
    global $conn;

    $sql = "UPDATE department_details 
            SET header_title=?, title=?, description=? 
            WHERE id=?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "sssi", $header_title, $title, $description, $id);

    mysqli_stmt_execute($stmt);

    // Check proper result
    if (mysqli_stmt_errno($stmt)) {
        return false; // Actual SQL error
    }

    return true; // Query executed successfully
}








// function for getting profile information from the database via ID



function get_departmentdetails_info_by_departmentid($id)

{





    global $conn;



    $sql_depart_details = "SELECT * FROM department_details WHERE deleted = 'no' AND department_id ='$id' ";



    $res_depart_details = mysqli_query($conn, $sql_depart_details);



    if (mysqli_num_rows($res_depart_details)) {

        return (mysqli_fetch_all($res_depart_details, MYSQLI_ASSOC));
    } else {

        return null;
    }
}







function get_departmentdetails_info_by($id)

{





    global $conn;



    $sql_depart_details = "SELECT * FROM department_details WHERE deleted = 'no' AND id ='$id' ";



    $res_depart_details = mysqli_query($conn, $sql_depart_details);



    if (mysqli_num_rows($res_depart_details)) {

        return (mysqli_fetch_all($res_depart_details, MYSQLI_ASSOC));
    } else {

        return null;
    }
}



















// Functions for department faq





// function for getting department faq information from the database

function get_departmentfaq_info()

{





    global $conn;



    $sql_depart_faq = "SELECT * FROM department_faq WHERE deleted = 'no'";



    $res_depart_faq = mysqli_query($conn, $sql_depart_faq);



    if (mysqli_num_rows($res_depart_faq)) {

        return (mysqli_fetch_all($res_depart_faq, MYSQLI_ASSOC));
    } else {

        return null;
    }
}





// function for inserting department faq information into the database





function add_departmentfaq_info($title, $description, $dept_details_id)
{
    global $conn;

    // Prepare the SQL statement
    $sql_depart_faq = "INSERT INTO department_faq (title, description, dept_details_id) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql_depart_faq);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssi", $title, $description, $dept_details_id);

    // Execute the statement
    $res_depart_faq = mysqli_stmt_execute($stmt);

    return $res_depart_faq ? true : false;
}






// function for update department faq information into the database



function update_departmentfaq_info($id, $title, $description)
{
    global $conn;

    // Prepare the SQL statement
    $sql_depart_faq = "UPDATE department_faq SET title=?, description=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql_depart_faq);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssi", $title, $description, $id);

    // Execute the statement
    $res_depart_faq = mysqli_stmt_execute($stmt);

    return $res_depart_faq ? true : false;
}






// function for getting department faq information from the database via ID



function get_departmentfaq_info_by_departmentdetailsid($id)

{





    global $conn;



    $sql_depart_faq = "SELECT * FROM department_faq WHERE deleted = 'no' AND dept_details_id ='$id' ";



    $res_depart_faq = mysqli_query($conn, $sql_depart_faq);



    if (mysqli_num_rows($res_depart_faq)) {

        return (mysqli_fetch_all($res_depart_faq, MYSQLI_ASSOC));
    } else {

        return null;
    }
}







function get_departmentfaq_info_by($id)

{





    global $conn;



    $sql_depart_faq = "SELECT * FROM department_faq WHERE deleted = 'no' AND id ='$id' ";



    $res_depart_faq = mysqli_query($conn, $sql_depart_faq);



    if (mysqli_num_rows($res_depart_faq)) {

        return (mysqli_fetch_all($res_depart_faq, MYSQLI_ASSOC));
    } else {

        return null;
    }
}





















// Functions for department disease





// function for getting department disease information from the database

function get_departmentdisease_info()

{





    global $conn;



    $sql_depart_disease = "SELECT * FROM department_disease WHERE deleted = 'no'";



    $res_depart_disease = mysqli_query($conn, $sql_depart_disease);



    if (mysqli_num_rows($res_depart_disease)) {

        return (mysqli_fetch_all($res_depart_disease, MYSQLI_ASSOC));
    } else {

        return null;
    }
}





// function for inserting department disease  information into the database





function add_departmentdisease_info($title, $image, $dept_details_id)
{
    global $conn;

    // Prepare the SQL statement
    $sql_depart_disease = "INSERT INTO department_disease (title, image, dept_details_id) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql_depart_disease);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssi", $title, $image, $dept_details_id);

    // Execute the statement
    $res_depart_disease = mysqli_stmt_execute($stmt);

    return $res_depart_disease ? true : false;
}






// function for update department disease  information into the database



function update_departmentdisease_info($id, $title, $image)
{
    global $conn;

    // Prepare the SQL statement
    $sql_depart_disease = "UPDATE department_disease SET title = ?, image = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql_depart_disease);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssi", $title, $image, $id);

    // Execute the statement
    $res_depart_disease = mysqli_stmt_execute($stmt);

    return $res_depart_disease ? true : false;
}






// function for getting department disease  information from the database via ID



function get_departmentdisease_info_by_departmentdetailsid($id)

{





    global $conn;



    $sql_depart_disease = "SELECT * FROM department_disease WHERE deleted = 'no' AND dept_details_id ='$id' ";



    $res_depart_disease = mysqli_query($conn, $sql_depart_disease);



    if (mysqli_num_rows($res_depart_disease)) {

        return (mysqli_fetch_all($res_depart_disease, MYSQLI_ASSOC));
    } else {

        return null;
    }
}







function get_departmentdisease_info_by($id)

{





    global $conn;



    $sql_depart_disease = "SELECT * FROM department_disease WHERE deleted = 'no' AND id ='$id' ";



    $res_depart_disease = mysqli_query($conn, $sql_depart_disease);



    if (mysqli_num_rows($res_depart_disease)) {

        return (mysqli_fetch_all($res_depart_disease, MYSQLI_ASSOC));
    } else {

        return null;
    }
}









//  department disease upload image



function DiseaseUploadImage($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}











//  department disease update image





function DiseaseUpdateImage($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}











// Functions for department disease list





// function for getting department disease list information from the database

function get_departmentdiseaselist_info()

{





    global $conn;



    $sql_depart_disease_list = "SELECT * FROM department_disease_list WHERE deleted = 'no'";



    $res_depart_disease_list = mysqli_query($conn, $sql_depart_disease_list);



    if (mysqli_num_rows($res_depart_disease_list)) {

        return (mysqli_fetch_all($res_depart_disease_list, MYSQLI_ASSOC));
    } else {

        return null;
    }
}





// function for inserting department disease list  information into the database





function add_departmentdiseaselist_info($title, $dept_disease_id)
{
    global $conn;

    // Prepare the SQL statement
    $sql_depart_disease_list = "INSERT INTO department_disease_list (title, dept_disease_id) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql_depart_disease_list);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "si", $title, $dept_disease_id);

    // Execute the statement
    $res_depart_disease_list = mysqli_stmt_execute($stmt);

    return $res_depart_disease_list ? true : false;
}






// function for update department disease  list information into the database



function update_departmentdiseaselist_info($id, $title)
{
    global $conn;

    // Prepare the SQL statement
    $sql_depart_disease_list = "UPDATE department_disease_list SET title = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql_depart_disease_list);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "si", $title, $id);

    // Execute the statement
    $res_depart_disease_list = mysqli_stmt_execute($stmt);

    return $res_depart_disease_list ? true : false;
}





// function for getting department disease  list information from the database via ID



function get_departmentdiseaselist_info_by_departmentdiseaseid($id)

{





    global $conn;



    $sql_depart_disease_list = "SELECT * FROM department_disease_list WHERE deleted = 'no' AND dept_disease_id ='$id' ";



    $res_depart_disease_list = mysqli_query($conn, $sql_depart_disease_list);



    if (mysqli_num_rows($res_depart_disease_list)) {

        return (mysqli_fetch_all($res_depart_disease_list, MYSQLI_ASSOC));
    } else {

        return null;
    }
}







function get_departmentdiseaselist_info_by($id)

{





    global $conn;



    $sql_depart_disease_list = "SELECT * FROM department_disease_list WHERE deleted = 'no' AND id ='$id' ";



    $res_depart_disease_list = mysqli_query($conn, $sql_depart_disease_list);



    if (mysqli_num_rows($res_depart_disease_list)) {

        return (mysqli_fetch_all($res_depart_disease_list, MYSQLI_ASSOC));
    } else {

        return null;
    }
}



































// Functions for department cure





// function for getting department cure information from the database

function get_departmentcure_info()

{





    global $conn;



    $sql_depart_cure = "SELECT * FROM department_cure WHERE deleted = 'no'";



    $res_depart_cure = mysqli_query($conn, $sql_depart_cure);



    if (mysqli_num_rows($res_depart_cure)) {

        return (mysqli_fetch_all($res_depart_cure, MYSQLI_ASSOC));
    } else {

        return null;
    }
}





// function for inserting department cure  information into the database





function add_departmentcure_info($title, $image, $dept_details_id)
{
    global $conn;

    // Prepare the SQL statement
    $sql_depart_cure = "INSERT INTO department_cure (title, image, dept_details_id) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql_depart_cure);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssi", $title, $image, $dept_details_id);

    // Execute the statement
    $res_depart_cure = mysqli_stmt_execute($stmt);

    return $res_depart_cure ? true : false;
}





// function for update department cure  information into the database



function update_departmentcure_info($id, $title, $image)
{
    global $conn;

    // Prepare the SQL statement
    $sql_depart_cure = "UPDATE department_cure SET title = ?, image = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql_depart_cure);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssi", $title, $image, $id);

    // Execute the statement
    $res_depart_cure = mysqli_stmt_execute($stmt);

    return $res_depart_cure ? true : false;
}






// function for getting department cure  information from the database via ID



function get_departmentcure_info_by_departmentdetailsid($id)

{





    global $conn;



    $sql_depart_cure = "SELECT * FROM department_cure WHERE deleted = 'no' AND dept_details_id ='$id' ";



    $res_depart_cure = mysqli_query($conn, $sql_depart_cure);



    if (mysqli_num_rows($res_depart_cure)) {

        return (mysqli_fetch_all($res_depart_cure, MYSQLI_ASSOC));
    } else {

        return null;
    }
}







function get_departmentcure_info_by($id)

{





    global $conn;



    $sql_depart_cure = "SELECT * FROM department_cure WHERE deleted = 'no' AND id ='$id' ";



    $res_depart_cure = mysqli_query($conn, $sql_depart_cure);



    if (mysqli_num_rows($res_depart_cure)) {

        return (mysqli_fetch_all($res_depart_cure, MYSQLI_ASSOC));
    } else {

        return null;
    }
}









//  department cure upload image



function CureUploadImage($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}











//  department cure update image





function CureUpdateImage($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}











// Functions for department cure list





// function for getting department cure list information from the database

function get_departmentcurelist_info()

{





    global $conn;



    $sql_depart_cure_list = "SELECT * FROM department_cure_list WHERE deleted = 'no'";



    $res_depart_cure_list = mysqli_query($conn, $sql_depart_cure_list);



    if (mysqli_num_rows($res_depart_cure_list)) {

        return (mysqli_fetch_all($res_depart_cure_list, MYSQLI_ASSOC));
    } else {

        return null;
    }
}





// function for inserting department cure list  information into the database





function add_departmentcurelist_info($title, $dept_cure_id)
{
    global $conn;

    // Prepare the SQL statement
    $sql_depart_cure_list = "INSERT INTO department_cure_list (title, dept_cure_id) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql_depart_cure_list);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "si", $title, $dept_cure_id);

    // Execute the statement
    $res_depart_cure_list = mysqli_stmt_execute($stmt);

    return $res_depart_cure_list ? true : false;
}






// function for update department cure  list information into the database



function update_departmentcurelist_info($id, $title)
{
    global $conn;

    // Prepare the SQL statement
    $sql_depart_cure_list = "UPDATE department_cure_list SET title = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql_depart_cure_list);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "si", $title, $id);

    // Execute the statement
    $res_depart_cure_list = mysqli_stmt_execute($stmt);

    return $res_depart_cure_list ? true : false;
}





// function for getting department cure  list information from the database via ID



function get_departmentcurelist_info_by_departmentcureid($id)

{





    global $conn;



    $sql_depart_cure_list = "SELECT * FROM department_cure_list WHERE deleted = 'no' AND dept_cure_id ='$id' ";



    $res_depart_cure_list = mysqli_query($conn, $sql_depart_cure_list);



    if (mysqli_num_rows($res_depart_cure_list)) {

        return (mysqli_fetch_all($res_depart_cure_list, MYSQLI_ASSOC));
    } else {

        return null;
    }
}







function get_departmentdcurelist_info_by($id)

{





    global $conn;



    $sql_depart_cure_list = "SELECT * FROM department_cure_list WHERE deleted = 'no' AND id ='$id' ";



    $res_depart_cure_list = mysqli_query($conn, $sql_depart_cure_list);



    if (mysqli_num_rows($res_depart_cure_list)) {

        return (mysqli_fetch_all($res_depart_cure_list, MYSQLI_ASSOC));
    } else {

        return null;
    }
}











// function for department end !!!







































//    technology information 

function get_technology_info()

{





    global $conn;



    $sql_technology = "SELECT * FROM technologies WHERE deleted = 'no'";



    $res_technology = mysqli_query($conn, $sql_technology);



    if (mysqli_num_rows($res_technology)) {

        return (mysqli_fetch_all($res_technology, MYSQLI_ASSOC));
    } else {

        return null;
    }
}





//  inserting technology  information 





function add_technology_info($title, $description, $image)
{
    global $conn;

    // Escape special characters in the variables
    $title = mysqli_real_escape_string($conn, $title);
    $description = mysqli_real_escape_string($conn, $description);
    $image = mysqli_real_escape_string($conn, $image);

    // Construct SQL query
    $sql_technology = "INSERT INTO technologies (title, description, image)
                       VALUES ('$title', '$description', '$image')";

    // Execute query
    $res_technology = mysqli_query($conn, $sql_technology);

    // Check if query was successful
    if ($res_technology) {
        return true;
    } else {
        return false;
    }
}








//  update technology information 



function update_technology_info($id, $title, $description, $image)
{
    global $conn;

    // Escape special characters in the variables
    $title = mysqli_real_escape_string($conn, $title);
    $description = mysqli_real_escape_string($conn, $description);
    $image = mysqli_real_escape_string($conn, $image);

    // Construct SQL query
    $sql_technology = "UPDATE technologies SET title = '$title', description = '$description', image = '$image' WHERE id = '$id'";

    // Execute query
    $res_technology = mysqli_query($conn, $sql_technology);

    // Check if query was successful
    if ($res_technology) {
        return true;
    } else {
        return false;
    }
}








// technology information by ID



function get_technology_info_by($id)

{





    global $conn;



    $sql_technology = "SELECT * FROM technologies WHERE deleted = 'no' AND id ='$id'";



    $res_technology = mysqli_query($conn, $sql_technology);



    if (mysqli_num_rows($res_technology)) {

        return (mysqli_fetch_all($res_technology, MYSQLI_ASSOC));
    } else {

        return null;
    }
}











function get_technology_info_limit_desc()

{
    global $conn;
    $sql_technology = "SELECT * FROM technologies WHERE deleted = 'no'  ORDER BY id DESC LIMIT 3";
    $res_technology = mysqli_query($conn, $sql_technology);
    if (mysqli_num_rows($res_technology)) {
        return (mysqli_fetch_all($res_technology, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



//  technology upload image



function TechnologyUploadImage($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}











//  technology update image





function TechnologyUpdateImage($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}









// function for  technology details end !!!









































//  inserting about us information into the database





function add_about_us_info($title, $subtitle, $description, $image_one, $image_two, $image_three, $youtube_link, $bullet_point)

{

    global $conn;

    $sql_about = "INSERT INTO about_us (title,subtitle,description,image_one,image_two,image_three,youtube_link,bullet_point)

                   Values('$title','$subtitle','$description','$image_one','$image_two','$image_three','$youtube_link','$bullet_point')";

    $res_about = mysqli_query($conn, $sql_about);



    if ($res_about) {

        return True;
    } else {

        return False;
    }
}







// about us information from the database

function get_about_us_info()

{





    global $conn;



    $sql_about = "SELECT * FROM about_us WHERE deleted = 'no'";



    $res_about = mysqli_query($conn, $sql_about);



    if (mysqli_num_rows($res_about)) {

        return (mysqli_fetch_all($res_about, MYSQLI_ASSOC));
    } else {

        return null;
    }
}







//  update about us information into the database



function update_about_us_info($id, $title, $subtitle, $description, $image_one, $image_two, $image_three, $youtube_link, $bullet_point)
{
    global $conn;

    // Prepare the SQL statement
    $sql_about = "UPDATE about_us SET title=?, subtitle=?, description=?, image_one=?, image_two=?, image_three=?, youtube_link=?, bullet_point=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql_about);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssssssssi", $title, $subtitle, $description, $image_one, $image_two, $image_three, $youtube_link, $bullet_point, $id);

    // Execute the statement
    $res_about = mysqli_stmt_execute($stmt);

    return $res_about ? true : false;
}






//  about us type information  via ID



function get_about_us_info_by($id)

{





    global $conn;



    $sql_about = "SELECT * FROM about_us WHERE deleted = 'no' AND id ='$id'";



    $res_about = mysqli_query($conn, $sql_about);

    // $depart=mysqli_fetch_assoc($res_department);

    if (mysqli_num_rows($res_about)) {

        return (mysqli_fetch_assoc($res_about));
    } else {

        return null;
    }
}

















function AboutusUploadImage($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}















function AboutusUpdateImage($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}

























function AboutusTwoUploadImage($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}















function AboutusTwoUpdateImage($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}













function AboutusThreeUploadImage($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}















function AboutusThreeUpdateImage($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}







// function for about us end !!!











//  inserting testimonial information 





function add_testimonial_info($title, $description, $image)

{

    global $conn;

    $sql_testimonial = "INSERT INTO testimonial (title,description,image)

                   Values('$title','$description','$image')";

    $res_testimonial = mysqli_query($conn, $sql_testimonial);



    if ($res_testimonial) {

        return True;
    } else {

        return False;
    }
}







//   testimonial information 

function get_testimonial_info()

{





    global $conn;



    $sql_testimonial = "SELECT * FROM testimonial WHERE deleted = 'no'";



    $res_testimonial = mysqli_query($conn, $sql_testimonial);



    if (mysqli_num_rows($res_testimonial)) {

        return (mysqli_fetch_all($res_testimonial, MYSQLI_ASSOC));
    } else {

        return null;
    }
}









//  update testimonial information 




function update_testimonial_info($id, $image, $title, $description)
{
    global $conn;

    // Escape special characters in the title, description, and id variables
    $title = mysqli_real_escape_string($conn, $title);
    $description = mysqli_real_escape_string($conn, $description);
    $id = mysqli_real_escape_string($conn, $id);

    // Construct SQL query
    $sql_testimonial = "UPDATE testimonial SET image = '$image', title = '$title', description = '$description' WHERE id = '$id'";

    // Execute query
    $res_testimonial = mysqli_query($conn, $sql_testimonial);

    // Check if query was successful
    if ($res_testimonial) {
        return true;
    } else {
        return false;
    }
}





// testimonial information by ID



function get_testimonial_info_by($id)

{





    global $conn;



    $res_testimonial = "SELECT * FROM testimonial WHERE deleted = 'no' AND id ='$id'";



    $res_testimonial = mysqli_query($conn, $res_testimonial);



    if (mysqli_num_rows($res_testimonial)) {

        return (mysqli_fetch_all($res_testimonial, MYSQLI_ASSOC));
    } else {

        return null;
    }
}







// testimonial upload image



function TestimonialUploadImage($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}











// testimonial update image





function TestimonialUpdateImage($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}







// function for testimonial details end !!!













//  inserting testimonial_yt_links information 





function add_yt_links_info($youtube_link)
{
    global $conn;

    // Escape special characters in the youtube_link variable
    $youtube_link = mysqli_real_escape_string($conn, $youtube_link);

    // Construct SQL query
    $sql_insert = "INSERT INTO testimonial_yt_links (youtube_link) VALUES ('$youtube_link')";

    // Execute query
    $res_insert = mysqli_query($conn, $sql_insert);

    // Check if query was successful
    if ($res_insert) {
        return true;
    } else {
        return false;
    }
}








//  testimonial_yt_links information 







function get_yt_links_info()

{





    global $conn;



    $sql_yt_links = "SELECT * FROM testimonial_yt_links WHERE deleted = 'no' ";



    $res_yt_links = mysqli_query($conn, $sql_yt_links);



    if (mysqli_num_rows($res_yt_links)) {

        return (mysqli_fetch_all($res_yt_links, MYSQLI_ASSOC));
    } else {

        return null;
    }
}


function get_yt_links_info_limit_desc()

{





    global $conn;



    $sql_yt_links = "SELECT * FROM testimonial_yt_links WHERE deleted = 'no' ORDER BY id DESC LIMIT 3 ";



    $res_yt_links = mysqli_query($conn, $sql_yt_links);



    if (mysqli_num_rows($res_yt_links)) {

        return (mysqli_fetch_all($res_yt_links, MYSQLI_ASSOC));
    } else {

        return null;
    }
}






// update yt_links information



function update_yt_links_info($id, $youtube_link)

{

    global $conn;

    // Escape special characters in the title, description, and id variables

    $youtube_link = mysqli_real_escape_string($conn, $youtube_link);
    $id = mysqli_real_escape_string($conn, $id);

    $sql_update_yt_links = "UPDATE testimonial_yt_links SET youtube_link='$youtube_link' where id = '$id';";

    $res_update_yt_links = mysqli_query($conn, $sql_update_yt_links);





    if ($res_update_yt_links) {

        return True;
    } else {

        return False;
    }
}





//  getting yt_links information by id



function get_yt_links_info_by($id)

{





    global $conn;



    $sql_yt_links = "SELECT * FROM testimonial_yt_links WHERE deleted = 'no' AND id ='$id'";



    $res_yt_links = mysqli_query($conn, $sql_yt_links);



    if (mysqli_num_rows($res_yt_links)) {

        return (mysqli_fetch_all($res_yt_links, MYSQLI_ASSOC));
    } else {

        return null;
    }
}



// function for yt_links end !!!

















// function for banners_image start !!!







//  inserting banners_image information into the database





function add_banners_image_info($alliance_image, $patient_testi_image, $doctor_image, $health_package_image, $awards_image, $gallery_image, $contact_image, $career_image, $academics_image, $technologies_image, $privacy_policy_image, $legal_compliances_image, $home_care_image, $book_appointment, $reports)

{

    global $conn;

    $sql_banners_image = "INSERT INTO banners_image (alliance_image,patient_testi_image,doctor_image,health_package_image,awards_image,gallery_image,contact_image,career_image,academics_image,technologies_image,privacy_policy_image,legal_compliances_image,home_care_image,book_appointment,reports)

                   Values('$alliance_image','$patient_testi_image','$doctor_image','$health_package_image','$awards_image','$gallery_image','$contact_image','$career_image','$academics_image','$technologies_image','$privacy_policy_image','$legal_compliances_image','$home_care_image','$book_appointment','$reports')";

    $res_banners_image = mysqli_query($conn, $sql_banners_image);



    if ($res_banners_image) {

        return True;
    } else {

        return False;
    }
}







// banners_image information from the database

function get_banners_image_info()

{





    global $conn;



    $sql_about = "SELECT * FROM banners_image WHERE deleted = 'no'";



    $res_about = mysqli_query($conn, $sql_about);



    if (mysqli_num_rows($res_about)) {

        return (mysqli_fetch_all($res_about, MYSQLI_ASSOC));
    } else {

        return null;
    }
}







//  update banners_image information into the database



function update_banners_image_info($id, $alliance_image, $patient_testi_image, $doctor_image, $health_package_image, $awards_image, $contact_image, $career_image, $academics_image, $technologies_image, $privacy_policy_image, $legal_compliances_image, $home_care_image, $book_appointment, $reports)

{

    global $conn;



    $sql_about = "UPDATE banners_image SET alliance_image = '$alliance_image',patient_testi_image = '$patient_testi_image',doctor_image = '$doctor_image',health_package_image = '$health_package_image',awards_image = '$awards_image',contact_image = '$contact_image' ,career_image = '$career_image',academics_image = '$academics_image',technologies_image = '$technologies_image',academics_image = '$academics_image',technologies_image = '$technologies_image',privacy_policy_image = '$privacy_policy_image',legal_compliances_image = '$legal_compliances_image',home_care_image = '$home_care_image',book_appoints = '$book_appointment',reports = '$reports' where id = '$id'";

    $res_about = mysqli_query($conn, $sql_about);





    if ($res_about) {

        return True;
    } else {

        return False;
    }
}





//  banners_image type information  via ID



function get_banners_image_info_by($id)

{





    global $conn;



    $sql_about = "SELECT * FROM banners_image WHERE deleted = 'no' AND id ='$id'";



    $res_about = mysqli_query($conn, $sql_about);

    // $depart=mysqli_fetch_assoc($res_department);

    if (mysqli_num_rows($res_about)) {

        return (mysqli_fetch_assoc($res_about));
    } else {

        return null;
    }
}

















function AllianceimageUpload($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}















function AllianceimageUpdate($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}

























function PatientTimageUpload($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}















function PatientTimageUpdate($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}













function DoctorimageUpload($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}















function DoctorimageUpdate($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}









function HealthimageUpload($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}















function HealthimageUpdate($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}







function AwardsimageUpload($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}















function AwardsimageUpdate($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}















function ContactimageUpload($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}











function ContactimageUpdate($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}







function CareerimageUpload($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}











function CareerimageUpdate($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}









function AcademicsimageUpload($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}















function AcademicsimageUpdate($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}











function TechnologyimageUpload($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}















function TechnologyimageUpdate($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}

















function PrivacyPolicyimageUpload($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}















function PrivacyPolicyimageUpdate($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}











function LegalCompliancesimageUpload($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}















function LegalCompliancesimageUpdate($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}















function HomeCareimageUpload($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}















function HomeCareimageUpdate($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}





















function BookAppointimageUpload($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}















function  BookAppointimageUpdate($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}























function ReportsimageUpload($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}















function  ReportsimageUpdate($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}









// function for banner details end !!!





















//  inserting cerrtificates information 





function add_certificates_info($image, $title, $description)
{
    global $conn;

    // Escape special characters in the title, description, and image variables
    $title = mysqli_real_escape_string($conn, $title);
    $description = mysqli_real_escape_string($conn, $description);
    $image = mysqli_real_escape_string($conn, $image);

    // Construct SQL query
    $sql_certificates = "INSERT INTO certificates (image, title, description) VALUES ('$image', '$title', '$description')";

    // Execute query
    $res_certificates = mysqli_query($conn, $sql_certificates);

    // Check if query was successful
    if ($res_certificates) {
        return true;
    } else {
        return false;
    }
}







//   cerrtificates information 

function get_certificates_info()

{





    global $conn;



    $sql_certificates = "SELECT * FROM certificates WHERE deleted = 'no'";



    $res_certificates = mysqli_query($conn, $sql_certificates);



    if (mysqli_num_rows($res_certificates)) {

        return (mysqli_fetch_all($res_certificates, MYSQLI_ASSOC));
    } else {

        return null;
    }
}









//  update cerrtificates information 



function update_certificates_info($id, $image, $title, $description)
{
    global $conn;

    // Escape special characters in the title, description, and id variables
    $title = mysqli_real_escape_string($conn, $title);
    $description = mysqli_real_escape_string($conn, $description);
    $id = mysqli_real_escape_string($conn, $id);

    // Construct SQL query
    $sql_certificates = "UPDATE certificates SET image = '$image', title = '$title', description = '$description' WHERE id = '$id'";

    // Execute query
    $res_certificates = mysqli_query($conn, $sql_certificates);

    // Check if query was successful
    if ($res_certificates) {
        return true;
    } else {
        return false;
    }
}








// cerrtificates information by ID



function get_certificates_info_by($id)

{





    global $conn;



    $sql_certificates = "SELECT * FROM certificates WHERE deleted = 'no' AND id ='$id'";



    $res_certificates = mysqli_query($conn, $sql_certificates);



    if (mysqli_num_rows($res_certificates)) {

        return (mysqli_fetch_all($res_certificates, MYSQLI_ASSOC));
    } else {

        return null;
    }
}







// cerrtificates upload image



function CertificatesUploadImage($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}











// cerrtificates update image





function CertificatesUpdateImage($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}









// function for Certificates details end !!!





















// legal & compliance details information 







function get_legal_comp_info()

{





    global $conn;



    $sql_legal_comp = "SELECT * FROM legal_comp WHERE deleted = 'no' ";



    $res_legal_comp = mysqli_query($conn, $sql_legal_comp);



    if (mysqli_num_rows($res_legal_comp)) {

        return (mysqli_fetch_all($res_legal_comp, MYSQLI_ASSOC));
    } else {

        return null;
    }
}











// update legal & compliance details information



function update_legal_comp_info($id, $details)
{
    global $conn;

    // Escape special characters in the details and id variables
    $details = mysqli_real_escape_string($conn, $details);
    $id = mysqli_real_escape_string($conn, $id);

    // Construct SQL query
    $sql_legal_comp = "UPDATE legal_comp SET details='$details' WHERE id='$id'";

    // Execute query
    $res_legal_comp = mysqli_query($conn, $sql_legal_comp);

    // Check if query was successful
    if ($res_legal_comp) {
        return true;
    } else {
        return false;
    }
}












function get_legal_comp_info_by($id)

{





    global $conn;



    $sql_legal_comp = "SELECT * FROM legal_comp WHERE deleted = 'no' AND id ='$id'";



    $res_legal_comp = mysqli_query($conn, $sql_legal_comp);

    // $depart=mysqli_fetch_assoc($res_department);

    if (mysqli_num_rows($res_legal_comp)) {

        return (mysqli_fetch_assoc($res_legal_comp));
    } else {

        return null;
    }
}





// function for legal & compliance details end !!!



















//  inserting second_opinion information 





function add_second_opinion_info($name, $number, $preffered_time, $file)

{

    global $conn;

    $sql_second_opinion = "INSERT INTO second_opinion (name,number,preffered_time,file)

                   Values('$name','$number','$preffered_time','$file')";

    $res_second_opinion = mysqli_query($conn, $sql_second_opinion);



    if ($res_second_opinion) {

        return True;
    } else {

        return False;
    }
}







//  second_opinion information 







function get_second_opinion_info()

{





    global $conn;



    $sql_second_opinion = "SELECT * FROM second_opinion WHERE deleted = 'no' ";



    $res_second_opinion = mysqli_query($conn, $sql_second_opinion);



    if (mysqli_num_rows($res_second_opinion)) {

        return (mysqli_fetch_all($res_second_opinion, MYSQLI_ASSOC));
    } else {

        return null;
    }
}











//  second_opinion information 







function get_second_opinion_info_id($id)

{





    global $conn;



    $sql_second_opinion = "SELECT * FROM second_opinion WHERE id='$id' AND deleted = 'no' ";



    $res_second_opinion = mysqli_query($conn, $sql_second_opinion);



    if (mysqli_num_rows($res_second_opinion)) {

        return (mysqli_fetch_all($res_second_opinion, MYSQLI_ASSOC));
    } else {

        return null;
    }
}







//  pdf second_opinion upload image



function second_opinion_uploadPdfFile($uploadedFile, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedFile['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedFile['tmp_name'];



        // Check if the file is a PDF

        $fileType = mime_content_type($tmpFilePath);

        if ($fileType !== 'application/pdf') {

            // Not a PDF, handle accordingly (you may want to provide an error message)

            return false;
        }



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedFile['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}























function get_second_opinion_info_desc()

{





    global $conn;



    $sql_second_opinion = "SELECT * FROM second_opinion WHERE deleted = 'no' ORDER BY id DESC";



    $res_second_opinion = mysqli_query($conn, $sql_second_opinion);



    if (mysqli_num_rows($res_second_opinion)) {

        return (mysqli_fetch_all($res_second_opinion, MYSQLI_ASSOC));
    } else {

        return null;
    }
}



// function for second opinion end !!!

























//  inserting equip_rent information 





function add_equip_rent_info($image, $equipment, $refund_secu_depo, $rent_day)
{
    global $conn;

    // Escape special characters in the variables
    $image = mysqli_real_escape_string($conn, $image);
    $equipment = mysqli_real_escape_string($conn, $equipment);
    $refund_secu_depo = mysqli_real_escape_string($conn, $refund_secu_depo);
    $rent_day = mysqli_real_escape_string($conn, $rent_day);

    // Construct SQL query
    $sql_equip_rent = "INSERT INTO equip_rent (image, equipment, refund_secu_depo, rent_day)
                       VALUES ('$image', '$equipment', '$refund_secu_depo', '$rent_day')";

    // Execute query
    $res_equip_rent = mysqli_query($conn, $sql_equip_rent);

    // Check if query was successful
    if ($res_equip_rent) {
        return true;
    } else {
        return false;
    }
}







//   allaince information 

function get_equip_rent_info()

{





    global $conn;



    $sql_equip_rent = "SELECT * FROM equip_rent WHERE deleted = 'no'";



    $res_equip_rent = mysqli_query($conn, $sql_equip_rent);



    if (mysqli_num_rows($res_equip_rent)) {

        return (mysqli_fetch_all($res_equip_rent, MYSQLI_ASSOC));
    } else {

        return null;
    }
}









//  update equip_rent information 



function update_equip_rent_info($id, $image, $equipment, $refund_secu_depo, $rent_day)
{
    global $conn;

    // Escape special characters in the variables
    $image = mysqli_real_escape_string($conn, $image);
    $equipment = mysqli_real_escape_string($conn, $equipment);
    $refund_secu_depo = mysqli_real_escape_string($conn, $refund_secu_depo);
    $rent_day = mysqli_real_escape_string($conn, $rent_day);

    // Construct SQL query
    $sql_equip_rent = "UPDATE equip_rent 
                       SET image = '$image',
                           equipment = '$equipment',
                           refund_secu_depo = '$refund_secu_depo',
                           rent_day = '$rent_day'
                       WHERE id = '$id'";

    // Execute query
    $res_equip_rent = mysqli_query($conn, $sql_equip_rent);

    // Check if query was successful
    if ($res_equip_rent) {
        return true;
    } else {
        return false;
    }
}








// equip_rent information by ID



function get_equip_rent_info_by($id)

{





    global $conn;



    $res_equip_rent = "SELECT * FROM equip_rent WHERE deleted = 'no' AND id ='$id'";



    $res_equip_rent = mysqli_query($conn, $res_equip_rent);



    if (mysqli_num_rows($res_equip_rent)) {

        return (mysqli_fetch_all($res_equip_rent, MYSQLI_ASSOC));
    } else {

        return null;
    }
}







// equip_rent upload image



function EquiprentUploadImage($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}











// Equiprent update image





function EquiprentUpdateImage($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}









// function for Equiprent details end !!!



















//  inserting home_care information 




function add_home_care_info($services, $charges)
{
    global $conn;

    // Escape special characters in the services and charges variables
    $services = mysqli_real_escape_string($conn, $services);
    $charges = mysqli_real_escape_string($conn, $charges);

    // Construct SQL query
    $sql_insert = "INSERT INTO home_care (services, charges) VALUES ('$services', '$charges')";

    // Execute query
    $res_insert = mysqli_query($conn, $sql_insert);

    // Check if query was successful
    if ($res_insert) {
        return true;
    } else {
        return false;
    }
}







//  home_care information 







function get_home_care_info()

{





    global $conn;



    $sql_home_care = "SELECT * FROM home_care WHERE deleted = 'no' ";



    $res_home_care = mysqli_query($conn, $sql_home_care);



    if (mysqli_num_rows($res_home_care)) {

        return (mysqli_fetch_all($res_home_care, MYSQLI_ASSOC));
    } else {

        return null;
    }
}





// update home_care information



function update_home_care_info($id, $services, $charges)
{
    global $conn;

    // Escape special characters in the services and charges variables
    $services = mysqli_real_escape_string($conn, $services);
    $charges = mysqli_real_escape_string($conn, $charges);

    // Construct SQL query
    $sql_update_home_care = "UPDATE home_care SET services = '$services', charges = '$charges' WHERE id = '$id'";

    // Execute query
    $res_update_home_care = mysqli_query($conn, $sql_update_home_care);

    // Check if query was successful
    if ($res_update_home_care) {
        return true;
    } else {
        return false;
    }
}





//  getting home_care information by id



function get_home_care_info_by($id)

{





    global $conn;



    $sql_home_care = "SELECT * FROM home_care WHERE deleted = 'no' AND id ='$id'";



    $res_home_care = mysqli_query($conn, $sql_home_care);



    if (mysqli_num_rows($res_home_care)) {

        return (mysqli_fetch_all($res_home_care, MYSQLI_ASSOC));
    } else {

        return null;
    }
}







// function for home_care end !!!

























//  inserting academics brochure information 





function add_acdBrochure_info($image, $name, $description, $pdf)
{
    global $conn;

    // Prepare the SQL statement
    $sql_healthpackage = "INSERT INTO academics_broch (image, name, description, pdf) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql_healthpackage);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssss", $image, $name, $description, $pdf);

    // Execute the statement
    $res_healthpackage = mysqli_stmt_execute($stmt);

    return $res_healthpackage ? true : false;
}








//    academics brochure information

function get_acdBrochure_info()

{





    global $conn;



    $sql_healthpackage = "SELECT * FROM academics_broch WHERE deleted = 'no'";



    $res_healthpackage = mysqli_query($conn, $sql_healthpackage);



    if (mysqli_num_rows($res_healthpackage)) {

        return (mysqli_fetch_all($res_healthpackage, MYSQLI_ASSOC));
    } else {

        return null;
    }
}









//  update  academics brochure information 



function update_acdBrochure_info($id, $image, $name, $description, $pdf)
{
    global $conn;

    // Prepare the SQL statement
    $sql_healthpackage = "UPDATE academics_broch SET image = ?, name = ?, description = ?, pdf = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql_healthpackage);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssssi", $image, $name, $description, $pdf, $id);

    // Execute the statement
    $res_healthpackage = mysqli_stmt_execute($stmt);

    return $res_healthpackage ? true : false;
}










//  academics brochure information  by ID



function get_acdBrochure_info_by($id)

{





    global $conn;



    $sql_healthpackage = "SELECT * FROM academics_broch WHERE deleted = 'no' AND id ='$id'";



    $sql_healthpackage = mysqli_query($conn, $sql_healthpackage);



    if (mysqli_num_rows($sql_healthpackage)) {

        return (mysqli_fetch_all($sql_healthpackage, MYSQLI_ASSOC));
    } else {

        return null;
    }
}









//   academics brochure information  by ID



function get_acd_Brochure_info_by($id)

{





    global $conn;



    $sql_healthpackage = "SELECT * FROM academics_broch WHERE deleted = 'no' AND id ='$id'";



    $sql_healthpackage = mysqli_query($conn, $sql_healthpackage);



    if (mysqli_num_rows($sql_healthpackage)) {

        return (mysqli_fetch_assoc($sql_healthpackage));
    } else {

        return null;
    }
}







//    academics brochure   upload image



function acdBrochureUploadImage($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}











// academics brochure  update image





function acdBrochureUpdateImage($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}









//    academics brochure   upload PDF



function acdBrochureuploadPdfFile($uploadedFile, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedFile['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedFile['tmp_name'];



        // Check if the file is a PDF

        $fileType = mime_content_type($tmpFilePath);

        if ($fileType !== 'application/pdf') {

            // Not a PDF, handle accordingly (you may want to provide an error message)

            return false;
        }



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedFile['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}









// academics brochure  update PDf













function acdBrochureUpdatePdfFile($oldPdfLink, $newPdfFile, $uploadDestination)

{

    // Check if the new PDF file was uploaded without errors

    if ($newPdfFile['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newPdfFile['tmp_name'];



        // Check if the file is a PDF

        $fileType = mime_content_type($tmpFilePath);

        if ($fileType !== 'application/pdf') {

            // Not a PDF, handle accordingly (you may want to provide an error message)

            return false;
        }



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newPdfFile['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old PDF if it exists

            if (file_exists($oldPdfLink)) {

                unlink($oldPdfLink);
            }



            // Return the new PDF link

            return $fileName;
        } else {

            // Error moving the file

            return $oldPdfLink;
        }
    } else {

        // Error uploading the new PDF file

        return $oldPdfLink;
    }
}











// function   academics brochure end !!!































//  inserting operator information 





function add_operator_info($username, $name, $mobile, $password, $member_type, $added_by)

{

    global $conn;

    $sql_insert = "INSERT INTO admin (m_id,name,mobile,password,member_type,added_by)

                   Values('$username','$name','$mobile','$password','$member_type','$added_by')";

    $res_insert = mysqli_query($conn, $sql_insert);



    if ($res_insert) {

        return True;
    } else {

        return False;
    }
}







//  operator information 







function get_operator_info()

{





    global $conn;



    $sql_academics = "SELECT * FROM admin WHERE deleted = 'no' and member_type='opt'";



    $res_academics = mysqli_query($conn, $sql_academics);



    if (mysqli_num_rows($res_academics)) {

        return (mysqli_fetch_all($res_academics, MYSQLI_ASSOC));
    } else {

        return null;
    }
}





// update operator information



function update_operator_info($id, $username, $name, $mobile, $password)

{

    global $conn;



    $sql_update_academics = "UPDATE admin SET m_id = '$username',name = '$name',mobile='$mobile',password='$password' where id = '$id';";

    $res_update_academics = mysqli_query($conn, $sql_update_academics);





    if ($res_update_academics) {

        return True;
    } else {

        return False;
    }
}





//  getting operator information by id



function get_operator_info_by($id)

{





    global $conn;



    $sql_academics = "SELECT * FROM admin WHERE deleted = 'no' AND id ='$id'";



    $res_academics = mysqli_query($conn, $sql_academics);



    if (mysqli_num_rows($res_academics)) {

        return (mysqli_fetch_all($res_academics, MYSQLI_ASSOC));
    } else {

        return null;
    }
}









function get_operator_info_limit_desc()

{





    global $conn;



    $sql_academics = "SELECT * FROM admin WHERE deleted = 'no' ORDER BY id DESC LIMIT 3 ";



    $res_academics = mysqli_query($conn, $sql_academics);



    if (mysqli_num_rows($res_academics)) {

        return (mysqli_fetch_all($res_academics, MYSQLI_ASSOC));
    } else {

        return null;
    }
}



// function for academics end !!!



















//  allowed_menu information 







function get_allowed_menu_info_by($id)

{





    global $conn;



    $sql_allowed_menu = "SELECT * FROM admin WHERE id ='$id' and deleted = 'no'";



    $res_allowed_menu = mysqli_query($conn, $sql_allowed_menu);



    if (mysqli_num_rows($res_allowed_menu)) {

        return (mysqli_fetch_all($res_allowed_menu, MYSQLI_ASSOC));
    } else {

        return null;
    }
}











// update allowed_menu information



function update_allowed_menu_info($id, $allowed_menu)

{

    global $conn;



    $sql_update_allowed_menu = "UPDATE admin SET allowed_menu ='$allowed_menu' where id = '$id' ";

    $res_update_allowed_menu = mysqli_query($conn, $sql_update_allowed_menu);





    if ($res_update_allowed_menu) {

        return True;
    } else {

        return False;
    }
}







//  allowed_menu information 







function get_menu_info()

{





    global $conn;



    $sql_menu = "SELECT * FROM menu WHERE deleted = 'no'";



    $res_menu = mysqli_query($conn, $sql_menu);



    if (mysqli_num_rows($res_menu)) {

        return (mysqli_fetch_all($res_menu, MYSQLI_ASSOC));
    } else {

        return null;
    }
}











// function for allowed_menu end !!!





























//  inserting all department information into the database





function add_all_department_info($slug, $name, $type)
{
    global $conn;

    // Escape special characters in variables
    $slug = mysqli_real_escape_string($conn, $slug);
    $name = mysqli_real_escape_string($conn, $name);
    $type = mysqli_real_escape_string($conn, $type);

    // Construct SQL query
    $sql_all_department = "INSERT INTO all_department (slug, name, type)
                           VALUES ('$slug', '$name', '$type')";

    // Execute query
    $res_all_department = mysqli_query($conn, $sql_all_department);

    // Check if query was successful
    if ($res_all_department) {
        return true;
    } else {
        // Log or display error message
        return false;
    }
}








// all departmentt information from the database

function get_all_department_info()

{





    global $conn;



    $sql_all_department = "SELECT * FROM all_department WHERE deleted = 'no'";



    $res_all_department = mysqli_query($conn, $sql_all_department);



    if (mysqli_num_rows($res_all_department)) {

        return (mysqli_fetch_all($res_all_department, MYSQLI_ASSOC));
    } else {

        return null;
    }
}




function get_all_department_info_orderby()
{
    global $conn;
    $sql_all_department = "SELECT * FROM all_department WHERE deleted = 'no 'ORDER BY name ";
    $res_all_department = mysqli_query($conn, $sql_all_department);
    if (mysqli_num_rows($res_all_department)) {
        return (mysqli_fetch_all($res_all_department, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



function get_all_department_info_orderby_priority()
{
    global $conn;
    $sql_all_department = "SELECT * FROM all_department WHERE deleted = 'no' AND priority > 0 ORDER BY priority ASC";
    $res_all_department = mysqli_query($conn, $sql_all_department);
    if (mysqli_num_rows($res_all_department) > 0) {
        return (mysqli_fetch_all($res_all_department, MYSQLI_ASSOC));
    } else {
        return null;
    }
}





//  update all department information into the database



function update_all_department_info($id, $slug, $name, $type)
{
    global $conn;

    // Prepare the SQL statement
    $sql_all_department = "UPDATE all_department SET slug=?, name=?, type=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql_all_department);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssii", $slug, $name, $type, $id);

    // Execute the statement
    $res_all_department = mysqli_stmt_execute($stmt);

    return $res_all_department ? true : false;
}








// function for getting all departmentt information from the database via ID



function get_all_department_info_by($id)

{





    global $conn;



    $sql_all_department = "SELECT * FROM all_department WHERE deleted = 'no' AND id ='$id'";



    $res_all_department = mysqli_query($conn, $sql_all_department);

    // $depart=mysqli_fetch_assoc($res_department);

    if (mysqli_num_rows($res_all_department)) {

        return (mysqli_fetch_assoc($res_all_department));
    } else {

        return null;
    }
}

















// all department information by slug from the database

function get_all_department_info_slug($department_slug)

{





    global $conn;



    $sql_all_department = "SELECT * FROM all_department WHERE  slug = '$department_slug' and deleted = 'no'";



    $res_all_department = mysqli_query($conn, $sql_all_department);



    if (mysqli_num_rows($res_all_department)) {

        return (mysqli_fetch_all($res_all_department, MYSQLI_ASSOC));
    } else {

        return null;
    }
}







function get_all_department_info_coe()

{





    global $conn;



    $sql_all_department = "SELECT * FROM all_department WHERE  dept_type='1' AND deleted = 'no' ";



    $res_all_department = mysqli_query($conn, $sql_all_department);



    if (mysqli_num_rows($res_all_department)) {

        return (mysqli_fetch_all($res_all_department, MYSQLI_ASSOC));
    } else {

        return null;
    }
}







function get_all_department_info_coe_rand()

{





    global $conn;







    $sql_all_department = "SELECT * FROM all_department WHERE  dept_type='1' AND deleted = 'no' ORDER BY RAND() LIMIT 6  ";



    $res_all_department = mysqli_query($conn, $sql_all_department);



    if (mysqli_num_rows($res_all_department)) {

        return (mysqli_fetch_all($res_all_department, MYSQLI_ASSOC));
    } else {

        return null;
    }
}









function get_all_department_info_specialities()

{





    global $conn;



    $sql_all_department = "SELECT * FROM all_department WHERE  dept_type='2' AND deleted = 'no'";



    $res_all_department = mysqli_query($conn, $sql_all_department);



    if (mysqli_num_rows($res_all_department)) {

        return (mysqli_fetch_all($res_all_department, MYSQLI_ASSOC));
    } else {

        return null;
    }
}













// all departmentt information from the database

function get_all_department_info_by_coe()

{





    global $conn;



    $sql_all_department = "SELECT * FROM all_department WHERE deleted = 'no'";



    $res_all_department = mysqli_query($conn, $sql_all_department);



    if (mysqli_num_rows($res_all_department)) {

        return (mysqli_fetch_all($res_all_department, MYSQLI_ASSOC));
    } else {

        return null;
    }
}



// function for all department end !!!





//  inserting all coe information into the database


function add_all_coe_info($coe_slug, $name, $logo_image, $image, $description, $meta_keyword, $meta_description, $meta_title)
{
    global $conn;

    // Escape special characters in variables
    $coe_slug = mysqli_real_escape_string($conn, $coe_slug);
    $name = mysqli_real_escape_string($conn, $name);
    $logo_image = mysqli_real_escape_string($conn, $logo_image);
    $image = mysqli_real_escape_string($conn, $image);
    $description = mysqli_real_escape_string($conn, $description);
    $meta_keyword = mysqli_real_escape_string($conn, $meta_keyword);
    $meta_description = mysqli_real_escape_string($conn, $meta_description);
    $meta_title = mysqli_real_escape_string($conn, $meta_title);

    // Construct SQL query
    $sql_all_coe = "INSERT INTO coe (coe_slug,name,logo_image, image, description, meta_keyword, meta_description, meta_title)
                   VALUES ('$coe_slug','$name','$logo_image', '$image', '$description', '$meta_keyword', '$meta_description', '$meta_title')";

    // Execute query
    $res_all_coe = mysqli_query($conn, $sql_all_coe);
    // Check if query was successful
    if ($res_all_coe) {
        return true;
    } else {
        // Log or display error message
        return false;
    }
}









// all coe information from the database

function get_all_coe_info()
{
    global $conn;
    $sql_all_department = "SELECT * FROM coe WHERE deleted = 'no'";
    $res_all_department = mysqli_query($conn, $sql_all_department);
    if (mysqli_num_rows($res_all_department)) {
        return (mysqli_fetch_all($res_all_department, MYSQLI_ASSOC));
    } else {
        return null;
    }
}







//  update all coe information into the database


function update_all_coe_info($id, $coe_slug, $name, $logo_image, $image, $description, $meta_keyword, $meta_description, $meta_title)
{
    global $conn;
    // Prepare the SQL statement
    $sql_all_coe = "UPDATE coe SET coe_slug=?, name=?,logo_image=?, image=?, description=?, meta_keyword=?, meta_description=?, meta_title=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql_all_coe);
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssssssssi", $coe_slug, $name, $logo_image, $image, $description, $meta_keyword, $meta_description, $meta_title, $id);
    // Execute the statement
    $res_all_coe = mysqli_stmt_execute($stmt);
    return $res_all_coe ? true : false;
}








// function for getting all coe information from the database via ID


function get_all_coe_info_by($id)
{
    global $conn;
    $sql_all_department = "SELECT * FROM coe WHERE deleted = 'no' AND id ='$id'";
    $res_all_department = mysqli_query($conn, $sql_all_department);
    // $depart=mysqli_fetch_assoc($res_department);
    if (mysqli_num_rows($res_all_department)) {
        return (mysqli_fetch_assoc($res_all_department));
    } else {
        return null;
    }
}



// function for getting all coe information from the database via ID


function get_all_coe_info_by_coe_slug($coe_slug)
{
    global $conn;
    $sql_all_department = "SELECT * FROM coe WHERE deleted = 'no' AND coe_slug ='$coe_slug'";
    $res_all_department = mysqli_query($conn, $sql_all_department);
    // $depart=mysqli_fetch_assoc($res_department);
    if (mysqli_num_rows($res_all_department)) {
        return (mysqli_fetch_assoc($res_all_department));
    } else {
        return null;
    }
}






// all coe information by slug from the database

function get_all_coe_info_slug($department_slug)
{
    global $conn;
    $sql_all_department = "SELECT * FROM coe WHERE  slug = '$department_slug' and deleted = 'no'";
    $res_all_department = mysqli_query($conn, $sql_all_department);
    if (mysqli_num_rows($res_all_department)) {
        return (mysqli_fetch_all($res_all_department, MYSQLI_ASSOC));
    } else {
        return null;
    }
}







function get_all_coe_info_coe()
{
    global $conn;
    $sql_all_department = "SELECT * FROM coe WHERE  dept_type='1' AND deleted = 'no' ";
    $res_all_department = mysqli_query($conn, $sql_all_department);
    if (mysqli_num_rows($res_all_department)) {
        return (mysqli_fetch_all($res_all_department, MYSQLI_ASSOC));
    } else {
        return null;
    }
}







function get_all_coe_info_coe_rand()
{
    global $conn;
    $sql_all_department = "SELECT * FROM coe WHERE  dept_type='1' AND deleted = 'no' ORDER BY RAND() LIMIT 6  ";
    $res_all_department = mysqli_query($conn, $sql_all_department);
    if (mysqli_num_rows($res_all_department)) {
        return (mysqli_fetch_all($res_all_department, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



function get_all_coe_info_specialities()
{
    global $conn;
    $sql_all_department = "SELECT * FROM coe WHERE  dept_type='2' AND deleted = 'no'";
    $res_all_department = mysqli_query($conn, $sql_all_department);
    if (mysqli_num_rows($res_all_department)) {
        return (mysqli_fetch_all($res_all_department, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



//    COE   logo upload image

function coeLogoUploadImage($uploadedImage, $uploadDestination)
{
    // Check if file was uploaded without errors
    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $uploadedImage['tmp_name'];
        // Generate a unique file name to prevent overwriting existing files
        $fileName = uniqid() . '_' . $uploadedImage['name'];
        // Build the target file path
        $targetFilePath = $uploadDestination . '/' . $fileName;
        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully
            return $fileName;
        } else {
            // Error moving the file
            return false;
        }
    } else {
        // Error uploading the file
        return false;
    }
}





// COE logo   update image

function coeLogoUpdateImage($oldImageLink, $newImage, $destination)
{
    // Check if the new image was uploaded without errors
    if ($newImage['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $newImage['tmp_name'];
        // Generate a unique file name to prevent overwriting existing files
        $fileName = uniqid() . '_' . $newImage['name'];
        // Build the target file path
        $targetFilePath = $destination . '/' . $fileName;
        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully, delete the old image if it exists
            if (file_exists($oldImageLink)) {
                unlink($oldImageLink);
            }
            // Return the new image link
            return $fileName;
        } else {
            // Error moving the file
            return $oldImageLink; // Return the old image link if there was an error
        }
    } else {
        // Error uploading the new imag
        return $oldImageLink; // Return the old image link if there was an error
    }
}




//    COE   upload image

function coeUploadImage($uploadedImage, $uploadDestination)
{
    // Check if file was uploaded without errors
    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $uploadedImage['tmp_name'];
        // Generate a unique file name to prevent overwriting existing files
        $fileName = uniqid() . '_' . $uploadedImage['name'];
        // Build the target file path
        $targetFilePath = $uploadDestination . '/' . $fileName;
        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully
            return $fileName;
        } else {
            // Error moving the file
            return false;
        }
    } else {
        // Error uploading the file
        return false;
    }
}





// COE   update image

function coeUpdateImage($oldImageLink, $newImage, $destination)
{
    // Check if the new image was uploaded without errors
    if ($newImage['error'] === UPLOAD_ERR_OK) {
        // Get the temporary file location
        $tmpFilePath = $newImage['tmp_name'];
        // Generate a unique file name to prevent overwriting existing files
        $fileName = uniqid() . '_' . $newImage['name'];
        // Build the target file path
        $targetFilePath = $destination . '/' . $fileName;
        // Move the temporary file to the desired destination
        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {
            // File uploaded successfully, delete the old image if it exists
            if (file_exists($oldImageLink)) {
                unlink($oldImageLink);
            }
            // Return the new image link
            return $fileName;
        } else {
            // Error moving the file
            return $oldImageLink; // Return the old image link if there was an error
        }
    } else {
        // Error uploading the new image
        return $oldImageLink; // Return the old image link if there was an error
    }
}

// function for all coe end !!!





//  inserting all coe information into the database

function add_all_coe_details_info($name, $coe_category)
{
    global $conn;
    $sql_all_department = "INSERT INTO coe_details (name,coe_category)
                   Values('$name','$coe_category')";
    $res_all_department = mysqli_query($conn, $sql_all_department);
    if ($res_all_department) {
        return True;
    } else {
        return False;
    }
}




// all coe information from the database

function get_all_coe_details_info()
{
    global $conn;
    $sql_all_department = "SELECT * FROM coe_details WHERE deleted = 'no'";
    $res_all_department = mysqli_query($conn, $sql_all_department);
    if (mysqli_num_rows($res_all_department)) {
        return (mysqli_fetch_all($res_all_department, MYSQLI_ASSOC));
    } else {
        return null;
    }
}




//  update all coe information into the database

function update_all_coe_details_info($id, $name, $coe_category)
{
    global $conn;
    $sql_all_department = "UPDATE department SET name = '$name',coe_category = '$coe_category' where id = '$id'";
    $res_all_department = mysqli_query($conn, $sql_all_department);
    if ($res_all_department) {
        return True;
    } else {
        return False;
    }
}





// function for getting all coe information from the database via ID

function get_all_coe_details_info_by($id)
{
    global $conn;
    $sql_all_department = "SELECT * FROM department WHERE deleted = 'no' AND id ='$id'";
    $res_all_department = mysqli_query($conn, $sql_all_department);
    // $depart=mysqli_fetch_assoc($res_department);
    if (mysqli_num_rows($res_all_department)) {
        return (mysqli_fetch_assoc($res_all_department));
    } else {
        return null;
    }
}



// all coe information by slug from the database

function get_all_coe_details_info_slug($department_slug)
{
    global $conn;
    $sql_all_department = "SELECT * FROM department WHERE  slug = '$department_slug' and deleted = 'no'";
    $res_all_department = mysqli_query($conn, $sql_all_department);
    if (mysqli_num_rows($res_all_department)) {
        return (mysqli_fetch_all($res_all_department, MYSQLI_ASSOC));
    } else {
        return null;
    }
}


function get_all_coe_details_info_coe()
{
    global $conn;
    $sql_all_department = "SELECT * FROM department WHERE  dept_type='1' AND deleted = 'no' ";
    $res_all_department = mysqli_query($conn, $sql_all_department);
    if (mysqli_num_rows($res_all_department)) {
        return (mysqli_fetch_all($res_all_department, MYSQLI_ASSOC));
    } else {
        return null;
    }
}




function get_all_coe_details_info_coe_rand()
{
    global $conn;
    $sql_all_department = "SELECT * FROM department WHERE  dept_type='1' AND deleted = 'no' ORDER BY RAND() LIMIT 6  ";
    $res_all_department = mysqli_query($conn, $sql_all_department);
    if (mysqli_num_rows($res_all_department)) {
        return (mysqli_fetch_all($res_all_department, MYSQLI_ASSOC));
    } else {
        return null;
    }
}




function get_all_coe_details_info_specialities()
{
    global $conn;
    $sql_all_department = "SELECT * FROM coe_details WHERE  dept_type='2' AND deleted = 'no'";
    $res_all_department = mysqli_query($conn, $sql_all_department);
    if (mysqli_num_rows($res_all_department)) {
        return (mysqli_fetch_all($res_all_department, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



function get_all_department_info_by_coe_id($type)
{
    global $conn;
    $sql_all_department = "SELECT * FROM all_department WHERE type='$type' and deleted = 'no'";
    $res_all_department = mysqli_query($conn, $sql_all_department);
    if (mysqli_num_rows($res_all_department)) {
        return (mysqli_fetch_all($res_all_department, MYSQLI_ASSOC));
    } else {
        return null;
    }
}



function get_details_coe_by_id($id)

{





    global $conn;



    $sql_depart_details = "SELECT * FROM all_department WHERE deleted = 'no' AND id ='$id' ";



    $res_depart_details = mysqli_query($conn, $sql_depart_details);



    if (mysqli_num_rows($res_depart_details)) {

        return (mysqli_fetch_assoc($res_depart_details));
    } else {

        return null;
    }
}







function add_department_info_for_coe($slug, $image, $dept_logo, $dept_type, $name, $dept_id, $short_desc, $banner_image, $coe_category, $coe_slug, $meta_keyword, $meta_description, $meta_title)
{
    global $conn;
    $sql_department = "INSERT INTO department (slug,image,dept_logo,dept_type,name,dept_id,short_desc,banner_image,coe_category,coe_slug,meta_keyword,meta_description,meta_title)
                   Values('$slug','$image','$dept_logo','$dept_type','$name','$dept_id','$short_desc','$banner_image','$coe_category','$coe_slug','$meta_keyword','$meta_description','$meta_title')";
    $res_department = mysqli_query($conn, $sql_department);
    if ($res_department) {
        return True;
    } else {
        return False;
    }
}




function get_departmentdetails()
{
    global $conn;
    $sql_all_department = "SELECT * FROM department WHERE deleted = 'no'";
    $res_all_department = mysqli_query($conn, $sql_all_department);
    if (mysqli_num_rows($res_all_department)) {
        return (mysqli_fetch_all($res_all_department, MYSQLI_ASSOC));
    } else {
        return null;
    }
}





function get_departmentdetails_info_by_coe_cat_slug($coe_category)

{



    global $conn;



    $sql_all_department = "SELECT * FROM department WHERE coe_slug='$coe_category' and deleted = 'no'";



    $res_all_department = mysqli_query($conn, $sql_all_department);



    if (mysqli_num_rows($res_all_department)) {

        return (mysqli_fetch_all($res_all_department, MYSQLI_ASSOC));
    } else {

        return null;
    }
}



function get_departmentdetails_info_by_coe_cat_id($coe_category)

{

    global $conn;
    $sql_all_department = "SELECT * FROM department WHERE coe_category='$coe_category' and deleted = 'no'";
    $res_all_department = mysqli_query($conn, $sql_all_department);
    if (mysqli_num_rows($res_all_department)) {
        return (mysqli_fetch_all($res_all_department, MYSQLI_ASSOC));
    } else {
        return null;
    }
}








function update_department_info_coe_details($id, $slug, $image, $dept_logo, $name, $short_desc, $banner_image, $meta_keyword, $meta_description, $meta_title)
{
    global $conn;

    // Prepare the SQL statement
    $sql_department = "UPDATE department SET slug=?, image=?, dept_logo=?, name=?, short_desc=?, banner_image=?, meta_keyword=?, meta_description=?, meta_title=? WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql_department);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sssssssssi", $slug, $image, $dept_logo, $name, $short_desc, $banner_image, $meta_keyword, $meta_description, $meta_title, $id);

    // Execute the statement
    $res_department = mysqli_stmt_execute($stmt);

    return $res_department ? true : false;
}








function get_coe_info_slug($department_slug)

{





    global $conn;



    $sql_department = "SELECT * FROM department WHERE  slug = '$department_slug' and deleted = 'no'";



    $res_department = mysqli_query($conn, $sql_department);



    if (mysqli_num_rows($res_department)) {

        return (mysqli_fetch_all($res_department, MYSQLI_ASSOC));
    } else {

        return null;
    }
}



// function for all coe end !!!













// Functions for department faq





// function for getting department faq information from the database

function get_coefaq_info()

{





    global $conn;



    $sql_coe_faq = "SELECT * FROM coe_faq WHERE deleted = 'no'";



    $res_coe_faq = mysqli_query($conn, $sql_coe_faq);



    if (mysqli_num_rows($res_coe_faq)) {

        return (mysqli_fetch_all($res_coe_faq, MYSQLI_ASSOC));
    } else {

        return null;
    }
}





// function for inserting department faq information into the database





function add_coefaq_info($title, $description, $coe_details_id, $coe_slug)
{
    global $conn;

    // Prepare the SQL statement
    $sql_coe_faq = "INSERT INTO coe_faq (title, description, coe_details_id,coe_slug) VALUES (?, ?, ?,?)";
    $stmt = mysqli_prepare($conn, $sql_coe_faq);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sssi", $title, $description, $coe_details_id, $coe_slug);

    // Execute the statement
    $res_coe_faq = mysqli_stmt_execute($stmt);

    return $res_coe_faq ? true : false;
}





// function for update department faq information into the database



function update_coefaq_info($id, $title, $description)
{
    global $conn;

    // Prepare the SQL statement
    $sql_coe_faq = "UPDATE coe_faq SET title = ?, description = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql_coe_faq);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssi", $title, $description, $id);

    // Execute the statement
    $res_coe_faq = mysqli_stmt_execute($stmt);

    if ($res_coe_faq) {
        return true;
    } else {
        return false;
    }
}






// function for getting department faq information from the database via ID



function get_coefaq_info_by_coedetailsid($id)

{





    global $conn;



    $sql_coe_faq = "SELECT * FROM coe_faq WHERE deleted = 'no' AND coe_details_id ='$id' ";



    $res_coe_faq = mysqli_query($conn, $sql_coe_faq);



    if (mysqli_num_rows($res_coe_faq)) {

        return (mysqli_fetch_all($res_coe_faq, MYSQLI_ASSOC));
    } else {

        return null;
    }
}



// function for getting department faq information from the database via ID



function get_coefaq_info_by_coedetailsid_coe_slug($coe_slug)

{





    global $conn;



    $sql_coe_faq = "SELECT * FROM coe_faq WHERE deleted = 'no' AND coe_slug ='$coe_slug' ";



    $res_coe_faq = mysqli_query($conn, $sql_coe_faq);



    if (mysqli_num_rows($res_coe_faq)) {

        return (mysqli_fetch_all($res_coe_faq, MYSQLI_ASSOC));
    } else {

        return null;
    }
}






function get_coefaq_info_by($id)

{





    global $conn;



    $sql_coe_faq = "SELECT * FROM coe_faq WHERE deleted = 'no' AND id ='$id' ";



    $res_coe_faq = mysqli_query($conn, $sql_coe_faq);



    if (mysqli_num_rows($res_coe_faq)) {

        return (mysqli_fetch_all($res_coe_faq, MYSQLI_ASSOC));
    } else {

        return null;
    }
}




// function for getting website maintenance information from the database

function get_website_maintenance_info()

{





    global $conn;



    $sql_career = "SELECT * FROM website_maintenance WHERE deleted = 'no'";



    $res_career = mysqli_query($conn, $sql_career);



    if (mysqli_num_rows($res_career)) {

        return (mysqli_fetch_all($res_career, MYSQLI_ASSOC));
    } else {

        return null;
    }
}




//  inserting website_maintenance_image information 





function add_website_maintenance_image_info($image)

{

    global $conn;

    $sql_alliance = "INSERT INTO website_maintenance (image)

                   Values('$image')";

    $res_alliance = mysqli_query($conn, $sql_alliance);



    if ($res_alliance) {

        return True;
    } else {

        return False;
    }
}







//   website_maintenance_image information 

function get_website_maintenance_image_info()

{





    global $conn;



    $sql_alliance = "SELECT * FROM website_maintenance WHERE deleted = 'no'";



    $res_alliance = mysqli_query($conn, $sql_alliance);



    if (mysqli_num_rows($res_alliance)) {

        return (mysqli_fetch_all($res_alliance, MYSQLI_ASSOC));
    } else {

        return null;
    }
}









//  update website_maintenance_image information 



function update_website_maintenance_image_info($id, $image)

{

    global $conn;



    $sql_alliance = "UPDATE website_maintenance SET image = '$image' where id = '$id';";

    $res_alliance = mysqli_query($conn, $sql_alliance);





    if ($res_alliance) {

        return True;
    } else {

        return False;
    }
}







// website_maintenance_image information by ID



function get_website_maintenance_image_info_by($id)

{





    global $conn;



    $res_alliance = "SELECT * FROM website_maintenance WHERE deleted = 'no' AND id ='$id'";



    $res_alliance = mysqli_query($conn, $res_alliance);



    if (mysqli_num_rows($res_alliance)) {

        return (mysqli_fetch_all($res_alliance, MYSQLI_ASSOC));
    } else {

        return null;
    }
}







// website_maintenance_image upload image



function website_maintenance_UploadImage($uploadedImage, $uploadDestination)

{

    // Check if file was uploaded without errors

    if ($uploadedImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $uploadedImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $uploadedImage['name'];



        // Build the target file path

        $targetFilePath = $uploadDestination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully

            return $fileName;
        } else {

            // Error moving the file

            return false;
        }
    } else {

        // Error uploading the file

        return false;
    }
}











// alliance update image





function website_maintenance_UpdateImage($oldImageLink, $newImage, $destination)

{

    // Check if the new image was uploaded without errors

    if ($newImage['error'] === UPLOAD_ERR_OK) {

        // Get the temporary file location

        $tmpFilePath = $newImage['tmp_name'];



        // Generate a unique file name to prevent overwriting existing files

        $fileName = uniqid() . '_' . $newImage['name'];



        // Build the target file path

        $targetFilePath = $destination . '/' . $fileName;



        // Move the temporary file to the desired destination

        if (move_uploaded_file($tmpFilePath, $targetFilePath)) {

            // File uploaded successfully, delete the old image if it exists

            if (file_exists($oldImageLink)) {

                unlink($oldImageLink);
            }



            // Return the new image link

            return $fileName;
        } else {

            // Error moving the file

            return $oldImageLink; // Return the old image link if there was an error

        }
    } else {

        // Error uploading the new image

        return $oldImageLink; // Return the old image link if there was an error

    }
}





function get_blogs_info_limit_desc_footer()

{
    global $conn;
    $sql_news = "SELECT * FROM awards_accolades WHERE deleted = 'no'  ORDER BY id DESC LIMIT 3";
    $res_news = mysqli_query($conn, $sql_news);
    if (mysqli_num_rows($res_news)) {
        return (mysqli_fetch_all($res_news, MYSQLI_ASSOC));
    } else {
        return null;
    }
}




// function for website_maintenance_image details end !!!
