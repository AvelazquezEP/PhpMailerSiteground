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

// Data to send Get from form.js (AJAX with Json) I change the name with the letter C 
$namec = $_POST['firstName'];
$lastNamec = $_POST['lastName'];
$emailc = $_POST['email'];
$numberc = $_POST['phone'];
$questionc = $_POST['message'];
$locationc = $_POST['00N5f00000SB1X0'];

// Data to send Get from index.html (CONTACT FORM)
$name = $_POST['first_name'];
$lastName = $_POST['last_name'];
$email = $_POST['email'];
$number = $_POST['mobile'];
$question = $_POST['message'];
$location = $_POST['00N5f00000SB1X0'];
$language = $_POST['00N5f00000SB1Ws'];
$sms = $_POST['00N5f00000SB1XU'];
$meetingType = $_POST['meetingType'];

// Convert inputs to Sting
$strName = strval($name);
$strlastName = strval($lastName);
$stremail = strval($email);
$strnumber = strval($number);
$strquestion = strval($question);
$strlocation = strval($location);
$strlanguage = strval($language);
$strsms = strval($sms);

try {

    // Email Template
    $message = file_get_contents('mailTemplate.html');
    $message = str_replace('%language%', $language, $message);
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
    // $mail->Username   = 'iquinones@abogadoericprice.com';
    // $mail->Password   = 'Marketing700!';
    $mail->Username   = 'support56@abogadoericprice.com';
    $mail->Password   = '473ECarnegie!';
    // $mail->Username   = 'avelazquez2873@LosAngelesImmigration.onmicrosoft.com';
    // $mail->Password   = '700Flower!';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('support56@abogadoericprice.com');
    // $mail->setFrom('iquinones@abogadoericprice.com', 'Mailer LAIA');    

    // $mail->addAddress('iku@abogadoericprice.com', 'Ivy Ku Flores');
    // $mail->addAddress('support56@abogadoericprice.com', 'Carolina');
    $mail->addAddress('avelazquez2873@LosAngelesImmigration.onmicrosoft.com', 'Alberto Velazquez');

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Someone has opted in to form AEP Google PPC';
    $mail->msgHTML($message);
    $mail->AltBody = 'Sending email';

    $mail->send();

    if($meetingType == "Phone"){
        switch ($location) {
            case "Los Angeles":            
                header("Location: https://greencardla.my.site.com/s/onlinescheduler?processId=a1h5f0000006rcbAAA&locationtype=VID_CONFERENCE&WhatId=a1n5f0000006fzTAAQ&WhereID=a1b5f000000eT4OAAU&sumoapp_WhoId=0055f000007NE9T" . "&a2=" . $strName . "&a3=" . $strlastName . "&a5=" . $stremail . "&a6=" . $strnumber . "&a7=EP-CA-Website");
                break;
            default:
            // IF something wrong
                header("Location: https://ericp138.sg-host.com/sorry.html");
                break;
        }
    }else {
        switch ($location) { //Falta chicago, san berdandino, National
            case "Los Angeles":            
                header("Location: https://greencardla.my.site.com/s/onlinescheduler?processId=a1h5f0000006rcbAAA&locationtype=OUR_LOCATION&WhatId=a1n5f0000006fzTAAQ&WhereID=a1b5f000000eT4OAAU&sumoapp_WhoId=0055f000007NE9T" . "&a2=" . $strName . "&a3=" . $strlastName . "&a5=" . $stremail . "&a6=" . $strnumber . "&a7=EP-CA-Website");
                break;
            case "Orange County":
                header("Location: https://greencardla.my.site.com/s/onlinescheduler?processId=a1h5f0000006rcbAAA&locationtype=OUR_LOCATION&WhatId=a1n5f0000006fzTAAQ&WhereID=a1b5f000000eT4PAAU&sumoapp_WhoId=0055f000007NE9T" . "&a2=" . $strName . "&a3=" . $strlastName . "&a5=" . $stremail . "&a6=" . $strnumber . "&a7=EP-CA-Website");
                break;
            case "San Diego":            
                header("Location: https://greencardla.my.site.com/s/onlinescheduler?processId=a1h5f0000006rcbAAA&locationtype=OUR_LOCATION&WhatId=a1n5f0000006fzTAAQ&WhereID=a1b5f000000eT8bAAE&sumoapp_WhoId=0055f000007NE9T" . "&a2=" . $strName . "&a3=" . $strlastName . "&a5=" . $stremail . "&a6=" . $strnumber . "&a7=EP-CA-Website");
                break;
            case "San Marcos":            
                header("Location: https://greencardla.my.site.com/s/onlinescheduler?processId=a1h5f0000006rcbAAA&locationtype=OUR_LOCATION&WhatId=a1n5f0000006fzTAAQ&WhereID=a1b5f000000eT8gAAE&sumoapp_WhoId=0055f000007NE9T" . "&a2=" . $strName . "&a3=" . $strlastName . "&a5=" . $stremail . "&a6=" . $strnumber . "&a7=EP-CA-Website");
                break;            
            default:
            // IF something wrong
                header("Location: https://ericp138.sg-host.com/sorry.html");
                break;
        }
    }
    
    // exit;
    
} catch (Exception $e) {
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    header("Location: https://ericp138.sg-host.com/sorry.html");    // <--- show this site when something is wrong
}