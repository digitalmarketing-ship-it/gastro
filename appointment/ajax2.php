<?php
require_once('../db_connect.php');
require_once('../functions.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

/* PHPMailer Files */
require_once __DIR__ . '/PHPMAILER/src/Exception.php';
require_once __DIR__ . '/PHPMAILER/src/PHPMailer.php';
require_once __DIR__ . '/PHPMAILER/src/SMTP.php';

header("Content-Type: application/json");

/* TOKEN */
$token = "e7e41fadbd451732530ef17ccfd63acd7106e074de0d43faa3f45e18f2116a41";

/* READ JSON INPUT */
$input = json_decode(file_get_contents("php://input"), true);

/* CHECK JSON */
if (!$input) {
    echo json_encode([
        "status" => false,
        "message" => "Invalid JSON data"
    ]);
    exit;
}

/* GET DATA */
$appointment_with = trim($input['appointment_with'] ?? '');
$appointment_date = trim($input['appointment_date'] ?? '');
$appointment_slot = trim($input['appointment_slot'] ?? '');
$comments         = trim($input['comments'] ?? '');
$name             = trim($input['name'] ?? '');
$phone            = trim($input['phone'] ?? '');
$email            = trim($input['email'] ?? '');

/* VALIDATION */
if (
    empty($appointment_with) ||
    empty($appointment_date) ||
    empty($appointment_slot) ||
    empty($name) ||
    empty($phone)
) {
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

curl_setopt_array($ch, [
    CURLOPT_URL => "https://cep.prodoc.ai/api/v1/appointment/book-appointment",
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_SSL_VERIFYPEER => true,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json",
        "Authorization: Bearer $token"
    ],
    CURLOPT_POSTFIELDS => json_encode($data)
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

/* CURL ERROR */
if (curl_errno($ch)) {
    echo json_encode([
        "status" => false,
        "message" => curl_error($ch)
    ]);
    curl_close($ch);
    exit;
}

curl_close($ch);

/* API RESPONSE */
$res = json_decode($response, true);

/* INVALID API RESPONSE */
if (!$res) {
    echo json_encode([
        "status" => false,
        "message" => "Invalid API response",
        "response" => $response
    ]);
    exit;
}

/* SUCCESS */
if (isset($res['status']) && $res['status'] == true) {

    $mail = new PHPMailer(true);

    try {

        /* SMTP SETTINGS */
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'digital.marketing@orchidmedcentre.in';
        $mail->Password   = 'grpmiezdjrsnvabp'; // Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        $mail->CharSet    = 'UTF-8';

        /* OPTIONAL DEBUG */
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';

        /* EMAIL DETAILS */
        $mail->setFrom('digital.marketing@orchidmedcentre.in', 'Appointment Booked - Website');
        $mail->addAddress('digitalmarketingomc2025@gmail.com');

        if (!empty($email)) {
            $mail->addReplyTo($email, $name);
        }

        /* CONTENT */
        $mail->isHTML(true);
        $mail->Subject = 'New Appointment Booking';

        $mail->Body = "
        <h2>New Appointment Booked</h2>
        <p><strong>Patient Name:</strong> {$name}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Phone:</strong> {$phone}</p>
        <p><strong>Date:</strong> {$appointment_date}</p>
        <p><strong>Time Slot:</strong> {$appointment_slot}</p>
        <p><strong>Comments:</strong> {$comments}</p>
        ";

        $mail->AltBody = "
New Appointment Booked

Patient Name: {$name}
Email: {$email}
Phone: {$phone}
Date: {$appointment_date}
Time Slot: {$appointment_slot}
Comments: {$comments}
";

        $mail->send();

        echo json_encode([
            "status" => true,
            "message" => "Appointment booked and Mail Sent",
            "appointment_id" => $res['appointment_id'] ?? ''
        ]);
        exit;

    } catch (Exception $e) {

        echo json_encode([
            "status" => true,
            "message" => "Appointment booked but Mail Not Sent",
            "mail_error" => $mail->ErrorInfo,
            "appointment_id" => $res['appointment_id'] ?? ''
        ]);
        exit;
    }

} else {

    echo json_encode([
        "status" => false,
        "message" => $res['message'] ?? 'Appointment booking failed',
        "api_response" => $res,
        "http_code" => $httpCode
    ]);
    exit;
}
?>