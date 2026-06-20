<?php
require_once('../db_connect.php');
require_once('../functions.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* PHPMailer Files */
require_once __DIR__ . '/PHPMAILER/src/Exception.php';
require_once __DIR__ . '/PHPMAILER/src/PHPMailer.php';
require_once __DIR__ . '/PHPMAILER/src/SMTP.php';

header("Content-Type: application/json");

/* TOKEN */
$token = "e7e41fadbd451732530ef17ccfd63acd7106e074de0d43faa3f45e18f2116a41";

/* READ JSON INPUT */
$input = json_decode(file_get_contents("php://input"), true);

/* GET DATA */
$appointment_with = $input['appointment_with'] ?? '';
$appointment_date = $input['appointment_date'] ?? '';
$appointment_slot = $input['appointment_slot'] ?? '';
$comments         = $input['comments'] ?? '';
$name             = $input['name'] ?? '';
$phone            = $input['phone'] ?? '';
$email            = $input['email'] ?? '';

/* VALIDATION */
if (!$appointment_with || !$appointment_date || !$appointment_slot || !$name || !$phone) {
    echo json_encode([
        "status" => false,
        "message" => "Missing required fields"
    ]);
    exit;
}

/* API PAYLOAD */
$data = [
    "appointment_with" => $appointment_with,
    "appointment_date" => $appointment_date,
    "appointment_slot" => $appointment_slot,
    "comments"         => $comments,
    "name"             => $name,
    "phone"            => $phone,
    "email"            => $email
];

/* CURL API CALL */
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://cep.prodoc.ai/api/v1/appointment/book-appointment");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer " . $token
]);

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);

/* CURL ERROR */
if (curl_errno($ch)) {
    echo json_encode([
        "status" => false,
        "message" => curl_error($ch)
    ]);
    exit;
}

curl_close($ch);

/* API RESPONSE */
$res = json_decode($response, true);

/* IF APPOINTMENT SUCCESS */
if (isset($res['status']) && $res['status'] == true) {

    $mail = new PHPMailer(true);

    try {

        /* SMTP SETTINGS */
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'digital.marketing@orchidmedcentre.in';
        $mail->Password   = 'grpm iezd jrsn vabp'; // Gmail App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        /* EMAIL DETAILS */
        $mail->setFrom('digitalmarketingomc2025@gmail.com', 'Orchid Medical Centre');
        $mail->addAddress('digitalmarketingomc2025@gmail.com');

        /* EMAIL CONTENT */
        $mail->isHTML(true);
        $mail->Subject = 'New Appointment Booking';

        $mail->Body = "
            <h2>Your Appointment is Booked</h2>
            <p><strong>Patient Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Phone:</strong> {$phone}</p>
            <p><strong>Date:</strong> {$appointment_date}</p>
            <p><strong>Time Slot:</strong> {$appointment_slot}</p>
            <p><strong>Comments:</strong> {$comments}</p>
        ";

        /* SEND MAIL */
        if ($mail->send()) {

            echo json_encode([
                "status" => true,
                "message" => "Appointment booked and Mail Sent",
                "appointment_id" => $res['appointment_id'] ?? ''
            ]);
            exit;

        } else {

            echo json_encode([
                "status" => true,
                "message" => "Appointment booked but Mail Not Sent",
                "appointment_id" => $res['appointment_id'] ?? ''
            ]);
            exit;
        }

    } catch (Exception $e) {

        echo json_encode([
            "status" => true,
            "message" => "Appointment booked but Mail Not Sent",
            "error" => $mail->ErrorInfo,
            "appointment_id" => $res['appointment_id'] ?? ''
        ]);
        exit;
    }

} else {

    echo json_encode([
        "status" => false,
        "message" => $res['message'] ?? 'Appointment booking failed'
    ]);
    exit;
}
?>