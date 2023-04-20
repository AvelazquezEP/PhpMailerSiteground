<?php

// 2da PARTE
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
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER; <-- imprime todos los pasos que realiza el proceso de enviar correo
    $mail->isSMTP();
    $mail->Host       = 'smtp.office365.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'support56@abogadoericprice.com';
    $mail->Password   = '473ECarnegie!';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    //Correo saliente
    $mail->setFrom('support56@abogadoericprice.com');

    // Correos a quienes le llegan
    // $mail->addAddress('iku@abogadoericprice.com', 'Ivy Ku Flores');
    $mail->addAddress('avelazquez2873@LosAngelesImmigration.onmicrosoft.com', 'Alberto Velazquez');

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Someone has opted in to form AEP Google PPC';
    $mail->msgHTML($message); //Toma el template(mailTemplate.html) para construtir el contenido del correo
    $mail->AltBody = 'Sending email'; // <-- Esta linea solo funciona para algun mensaje / NO SE UTILIZA puede quedar asi o comentada

    // Toma todos los parametros anteriorres y realiza el envio del correo
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
    // $NCode = ""; no tiene codigo ya que se registra como un APPOINTMENT VIRTUAL
    // $SBCode = ""; NO HAY CODIGO/ID

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

// Build the link for In-Person appointment
function redirectInPerson($loctionType, $locationCode, $name, $lastName, $email, $number, $location, $language, $sms)
{
    // El de la linea (Https://...) hace uso de un link para las citas en VIRTUAL (NATIONAL es el unico que tiene cita virtual)
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
    // El de la linea (Https://...) hace uso de un link para las citas en PERSON (TODOS EXCEPTO NATIONAL tienen cita IN-PERSON)
    $redirectLink = "https://greencardla.my.site.com/s/onlinescheduler?processId=a1h5f000000nAJZAA2&locationtype=" . $loctionType
        . "&WhatId=a1n5f0000006fzTAAQ&WhereID=" . $locationCode
        . "&sumoapp_WhoId=0055f000007NE9T"
        . "&a2=" . $name
        . "&a3=" . $lastName
        . "&a5=" . $email
        . "&a6=" . $number
        . "&a8=" . $location
        . "&a9=" . $language
        . "&a10=" . $sms;
    return $redirectLink;
}

// Revisa el tipo de cita (hace uso de select.js) con esto puede saber cual de las dos function anteriores puede usar para Virtual o In-Person
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

try {
    // Value de los inputs, estos los recibe directamente del Contact Form al enviarse por medio de un HTTP/POST en el ACTION
    $name = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $number = $_POST['mobile'];
    $question = $_POST['message'];
    $location = $_POST['00N5f00000SB1X0'];
    $language = $_POST['00N5f00000SB1Ws'];
    $sms = $_POST['00N5f00000SB1XU'];
    $meetingType = $_POST['meetingType'];
    $oid = $_POST['oid'];
    // $sourceLead = $_POST['sourceLead']; //No se necesita porque se registra directo en SUMO SCHEDULER

    // Toma los inputs anteriores y los convierte a STRING, esto se usa en ciertas functions.
    $strName = strval($name);
    $strlastName = strval($lastName);
    $stremail = strval($email);
    $strnumber = strval($number);
    $strquestion = strval($question);
    $strlocation = strval($location);
    $strlanguage = strval($language);
    $strsms = strval($sms);
    $strOid = strval($oid);
    // $strSourceLead = strval($sourceLead); //No se necesita porque se registra directo en SUMO SCHEDULER

    $locationCode = getLocation($location);

    // Send to WEB-TO-LEAD
    $url = "https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8";
    // Solo se usa la inforacion necesaria para la creacion del LEAD en SALESFORCE.
    $data = [
        'oid' => $strOid,
        'first_name' => $strName,
        'last_name' => $strlastName,
        'email' => $stremail,
        'mobile' => $strnumber
    ];

    // Se usa CURL para poder realizar un envio de tipo POST al $url, tomando en cuenta como parametros el array $data
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_exec($curl);
    curl_close($curl);    

    // Envia el correo con los datos obtenidos en las variables anteriores.
    sendEmail($strlanguage, $stremail, $strName, $strlastName, $strnumber, $question);

    // Obtenemos el link y lo almacenamos en una variable para poder usarlo en un Header y poder redireccionarlo
    $link = getLink($meetingType, $locationCode, $strName, $strlastName, $stremail, $strnumber, $strlocation, $strlanguage, $strsms);

    // Esperamos 5s antes de poder redirigir al link.
    // mientras pasa el tiempo declarado se moestrar una vista con informacion necesario (vista de espera o notificar que se esta procesando su informacion)
    // De esta forma podemos dar tiempo a que el proceso de creacino del LEAD se pueda completar
    header("refresh:5; url=" . $link);
    
} catch (Exception $e) {
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; <-- muestra un mensaje de informacion en caso de que falle
    header("Location: https://ericp138.sg-host.com/sorry.html");    // <--- Muestra esa vista cuando el proceso falle
}

?>

<!-- Empieza la vista que se muestra mientras se procesan los datos -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviando información</title>
</head>
<body>
    <div class="container">
        <div class="emailContainer">
            <h1 class="title">Enviando correo</h1>
            <p> Enviando correo </p>
        </div>
    </div>
</body>

</html>