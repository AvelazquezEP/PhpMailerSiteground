<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 2024 05:00:00 GMT"); //Update before 26/Jul/2024

try {
    // FirstName
    // LastName
    // Email
    // MobilePhone
    // Language
    // leadID

    $name = $_POST['FirstName'];
    $lasName = $_POST['LastName'];
    $email = $_POST['Email'];
    $mobile = $_POST['MobilePhone'];
    $language = $_POST['Language'];
    $leadID = $_POST['leadID'];
    $question = $_POST['question'];

    if(empty($question)){
        $question = "-";
    }

    // $strlanguage = "Spanish";
    // $stremail = "avelazquez2873@LosAngelesImmigration.onmicrosoft.com";
    // $strName = "Test";
    // $strlastName = "charmander";
    // $strnumber = "5556668881";
    // $question = "Prueba de correo";
    // Envia el correo con los datos obtenidos en las variables anteriores.    
    $sendEmail = sendEmail($language, $email, $name, $lasName, $mobile, $question, $leadID);

    echo $sendEmail;
} catch (Exception $ex) {
    echo "****Email Error****";
}

// Send a email
function sendEmail($language, $email, $name, $lastName, $number, $question, $leadID)
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
    $message = str_replace('%leadID%', $leadID, $message);

    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER; //<-- imprime todos los pasos que realiza el proceso de enviar correo
    $mail->isSMTP();
    $mail->Host       = 'smtp.office365.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'support56@abogadoericprice.com';
    $mail->Password   = '500LaTerrazaBlvd.';
    // $mail->Username   = 'avelazquez2873@LosAngelesImmigration.onmicrosoft.com';
    // $mail->Password   = '700Flower!';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    //Correo saliente
    $mail->setFrom('support56@abogadoericprice.com');
    // $mail->setFrom('avelazquez2873@LosAngelesImmigration.onmicrosoft.com');

    // Correos a quienes le llegan
    $mail->addAddress('iku@abogadoericprice.com', 'Ivy Ku Flores');
    $mail->addAddress('fmartinez@greencardla.com', 'Floriberta Martinez');
    $mail->addAddress('support56@abogadoericprice.com', 'Paola Carolina');
    $mail->addCC('rterrazas@greencardla.com', 'Robert Terrazas');
    $mail->addCC('avelazquez2873@LosAngelesImmigration.onmicrosoft.com', 'Alberto Martinez');

    //Content
    $mail->Encoding = 'base64';
    $mail->CharSet = "UTF-8";
    
    $mail->isHTML(true);
    $mail->Subject = 'Someone has opted in to contac form web site';
    $mail->msgHTML($message); //Toma el template(mailTemplate.html) para construtir el contenido del correo
    $mail->AltBody = 'Sending email'; // <-- Esta linea solo funciona para algun mensaje / NO SE UTILIZA puede quedar asi o comentada

    // Toma todos los parametros anteriorres y realiza el envio del correo
    $mail->send();
}
