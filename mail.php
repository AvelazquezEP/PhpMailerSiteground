<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
// require "dataBase.php";
// require 'C:\xampp\htdocs\PHPMailer\vendor\autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 2024 05:00:00 GMT"); //Update before 26/Jul/2024

// Data to send Get from form.js (AJAX with Json)
$name = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$number = $_POST['phone'];
$question = $_POST['message'];

try {

    // Email Template
    $message = file_get_contents('mailTemplate.html');
    $message = str_replace('%email%', $email, $message);
    $message = str_replace('%name%', $name, $message);
    $message = str_replace('%lastName%', $lastName, $message);
    $message = str_replace('%mobile%', $number, $message);
    $message = str_replace('%message%', $question, $message);

    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();

    $mail->Host       = 'smtp.office365.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'iquinones@abogadoericprice.com';
    $mail->Password   = 'Marketing700!';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;
    
    //Recipients
    $mail->setFrom('iquinones@abogadoericprice.com', 'Mailer LAIA');    

    // $mail->addAddress('iku@abogadoericprice.com', 'Ivy Ku Flores');
    $mail->addAddress('avelazquez2873@LosAngelesImmigration.onmicrosoft.com', 'Alberto Velazquez');
    // $mail->addAddress('support56@abogadoericprice.com', 'Carolina');

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Someone has opted in to form AEP Google PPC';
    $mail->msgHTML($message);    
    $mail->AltBody = 'Sending email';

    $mail->send();

    // header("https://greencardla.my.site.com/s/onlinescheduler?processId=a1h5f0000006rcbAAA&WhatId=a1n5f0000006fzJAAQ&WhereID=a1b5f000000eT4OAAU&sumoapp_WhoId=0055f000007NttK");
    header("Location: https://greencardla.my.site.com/s/onlinescheduler?processId=a1h5f0000006rcbAAA&WhatId=a1n5f0000006fzJAAQ&WhereID=a1b5f000000eT4OAAU&sumoapp_WhoId=0055f000007NttK");

}  catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
