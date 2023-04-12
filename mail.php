<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 2024 05:00:00 GMT"); //Update before 26/Jul/2024

// Data to send Get from form.js (AJAX with Json) I change the name with the letter C
// $response = array();


// $namec = $_POST['firstName'];
// $lastNamec = $_POST['lastName'];
// $emailc = $_POST['email'];
// $numberc = $_POST['phone'];
// $questionc = $_POST['message'];
// $locationc = $_POST['00N5f00000SB1X0'];

// Data to send Get from index.html (CONTACT FORM)
$name = $_POST['first_name'];
$lastName = $_POST['last_name'];
$email = $_POST['email'];
$number = $_POST['mobile'];
$question = $_POST['message'];
$location = $_POST['00N5f00000SB1X0'];
$language = $_POST['00N5f00000SB1Ws'];
$sms = $_POST['00N5f00000SB1XU'];
$meetingTypeP = $_POST['meetingType'];

// Convert inputs to Sting
$strName = strval($name);
$strlastName = strval($lastName);
$stremail = strval($email);
$strnumber = strval($number);
$strquestion = strval($question);
$strlocation = strval($location);
$strlanguage = strval($language);
$strsms = strval($sms);

// Location codes
$code = "";
$LACode = "a1b5f000000eT4OAAU";
$OCCode = "a1b5f000000eT4PAAU";
$SDCode = "a1b5f000000eT8bAAE";
$SMCode = "a1b5f000000eT8gAAE";
$CHCode = "a1b5f000000enBnAAI";
// $NCode = "a1b5f000000eT4OAAU"; TODAVIA NO HAY CODIGO
// $SBCode = "a1b5f000000eT4OAAU"; TODAVIA NO HAY CODIGO

switch ($location) { //IN-PERSON (Falta chicago, san berdandino, National)
    case "Los Angeles":
        $code = strval($LACode);        
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
        // $code = strval($NCode);
        break;
    case "San Bernardino":
        // $code = strval($SBCode);
        break;
    default:
        $code = strval($LACode);
        break;
}

// Location type
$locationT = "";
$phone = "VID_CONFERENCE";
$person = "OUR_LOCATION";

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

    if ($meetingTypeP == "VID_CONFERENCE") { //Phone/virtual
        $locationT = strval($phone);
        $link = redirectsVirtual($locationT, $code, $strName, $strlastName, $stremail, $strnumber, $strlocation, $strlanguage, $strsms);
    } else { //Person
        $locationT = strval($person);
        $link = redirects($locationT, $code, $strName, $strlastName, $stremail, $strnumber, $strlocation, $strlanguage, $strsms);
    }

    $output = redirectsVirtual($locationT, $code, $strName, $strlastName, $stremail, $strnumber, $strlocation, $strlanguage, $strsms);
    echo $output;
    // try {
    //     header("Location: " . $link);
    //     exit;
    // } catch(Exception $e) {
    //     header("Location: https://ericp138.sg-host.com/sorry.html");
    //     exit;
    // }

// Mandar pal JQUERY alv    

} catch (Exception $e) {
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    header("Location: https://ericp138.sg-host.com/sorry.html");    // <--- show this site when something is wrong
}


// Functions para redireccionar al Scheduler App (Virtual / person)
function redirects ($loctionType, $locationCode, $nameArg, $lastNameArg, $emailArg, $numberArg, $locationArg, $languageArg, $smsArg)
{    
    $redirectLink = "https://greencardla.my.site.com/s/onlinescheduler?processId=a1h5f000000nAJCAA2&locationtype=" . $loctionType . "&WhatId=a1n5f0000006fzTAAQ&WhereID=" . $locationCode . "&sumoapp_WhoId=0055f000007NE9T" . "&a2=" . $nameArg . "&a3=" . $lastNameArg . "&a5=" . $emailArg . "&a6=" . $numberArg . "&a8=" . $locationArg . "&a9=" . $languageArg . "&a10=" . $smsArg;
    return $redirectLink;
}

function redirectsVirtual ($loctionType, $locationCode, $nameArg, $lastNameArg, $emailArg, $numberArg, $locationArg, $languageArg, $smsArg)
{    
    $redirectLink = "https://greencardla.my.site.com/s/onlinescheduler?processId=a1h5f000000nAJZAA2&locationtype=" . $loctionType . "&WhatId=a1n5f0000006fzTAAQ&WhereID=" . $locationCode . "&sumoapp_WhoId=0055f000007NE9T" . "&a2=" . $nameArg . "&a3=" . $lastNameArg . "&a5=" . $emailArg . "&a6=" . $numberArg . "&a8=" . $locationArg . "&a9=" . $languageArg . "&a10=" . $smsArg;
    return $redirectLink;
}

function redirectsAjax ($loctionType, $locationCode, $nameArg, $lastNameArg, $emailArg, $numberArg, $locationArg, $languageArg, $smsArg)
{    
    $redirectLink = $link;
    return $redirectLink;
}