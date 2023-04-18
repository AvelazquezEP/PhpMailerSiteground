<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 2024 05:00:00 GMT"); //Update before 26/Jul/2024

// Send a email
function sendEmail($language, $email, $name, $lastName, $number, $question)
{
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
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
    $mail->Username   = 'support56@abogadoericprice.com';
    $mail->Password   = '473ECarnegie!';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('support56@abogadoericprice.com');

    // $mail->addAddress('iku@abogadoericprice.com', 'Ivy Ku Flores');
    $mail->addAddress('avelazquez2873@LosAngelesImmigration.onmicrosoft.com', 'Alberto Velazquez');

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Someone has opted in to form AEP Google PPC';
    $mail->msgHTML($message);
    $mail->AltBody = 'Sending email';

    // Enviar correo
    $mail->send();
}

// GET LOCATION CODE
function getLocation($location)
{
    $code = "";
    $LACode = "a1b5f000000eT4OAAU";
    $OCCode = "a1b5f000000eT4PAAU";
    $SDCode = "a1b5f000000eT8bAAE";
    $SMCode = "a1b5f000000eT8gAAE";
    $CHCode = "a1b5f000000enBnAAI";
    // $NCode = ""; TODAVIA NO HAY CODIGO
    // $SBCode = ""; TODAVIA NO HAY CODIGO

    switch ($location) { //IN-PERSON (Falta san berdandino)
        case "Los Angeles":
            $code = $LACode;
            break;
        case "Orange County":
            $code = strval($OCCode);
            break;
        case "San Diego":
            $code = strval($SDCode);
            break;
        case "San Marcos":
            $code = strval($SMCode);
            break;
        case "Chicago":
            $code = strval($CHCode);
            break;
        case "National":
            // $code = $LACode;
            // $code = strval($NCode);
            break;
        case "San Bernardino":
            // $code = strval($SBCode);
            break;
        default:
            $code = strval($LACode);
            break;
    }

    return $code;
}

// Build the link for InPerson appointment
function redirectInPerson($loctionType, $locationCode, $name, $lastName, $email, $number, $location, $language, $sms)
{
    // Los Angeles
    $personLink = "https://greencardla.my.site.com/s/onlinescheduler?processId=a1h5f000000nAJCAA2&locationtype=" . $loctionType
        . "&WhatId=a1n5f0000006fzTAAQ&WhereID=" . $locationCode
        . "&sumoapp_WhoId=0055f000007NE9T"
        . "&a2=" . $name
        . "&a3=" . $lastName
        . "&a5=" . $email
        . "&a6=" . $number
        . "&a8=" . $location
        . "&a9=" . $language
        . "&a10=" . $sms;
    return $personLink;
}

// Build the link for Virtual appointment
function redirectVirtual($loctionType, $locationCode, $name, $lastName, $email, $number, $location, $language, $sms)
{
    // Los Angeles
    $redirectLink = "https://greencardla.my.site.com/s/onlinescheduler?processId=a1h5f000000nAJZAA2&locationtype=" . $loctionType
        . "&WhatId=a1n5f0000006fzTAAQ&WhereID=" . $locationCode
        . "&sumoapp_WhoId=0055f000007NE9T"
        . "&a2=" . $name
        . "&a3=" . $lastName
        . "&a5=" . $email
        . "&a6=" . $number
        . "&a8=" . $location
        . "&a9=" . $language
        . "&a10=" . $sms;;
    return $redirectLink;
}

function getLink($meetingType, $locationCode, $name, $lastName, $email, $phoneNumber, $location, $language, $sms)
{
    $type = "";
    $phone = "VID_CONFERENCE"; //Virtual
    $person = "OUR_LOCATION"; //In-Person

    if ($meetingType == "Phone") { //Phone
        $type = strval($phone);
        $link = redirectVirtual($type, $locationCode, $name, $lastName, $email, $phoneNumber, $location, $language, $sms);
        return $link;
    } else { //Person
        $type = strval($person);
        $link = redirectInPerson($type, $locationCode, $name, $lastName, $email, $phoneNumber, $location, $language, $sms);
        return $link;
    }
}

// Location type

try {
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

    $locationCode = getLocation($location);

    // Function to Send email
    sendEmail($strlanguage, $stremail, $strName, $strlastName, $strnumber, $question);

    // Get the Link (URL for redirect to the scheduler app)
    $link = getLink($meetingType, $locationCode, $strName, $strlastName, $stremail, $strnumber, $strlocation, $strlanguage, $strsms);

    try {
        header("Location: " . $link);
        exit;
    } catch (Exception $e) {
        header("Location: https://ericp138.sg-host.com/sorry.html");
        exit;
    }
} catch (Exception $e) {
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    header("Location: https://ericp138.sg-host.com/sorry.html");    // <--- show this site when something is wrong
}