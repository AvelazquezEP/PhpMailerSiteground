<?php

// header("Cache-Control: no-cache, must-revalidate");
// header("Expires: Mon, 26 Jul 2024 05:00:00 GMT"); //Update before 26/Jul/2024


// Location codes
function getLocation($locationArg)
{
    $code = "";
    $LACode = "a1b5f000000eT4OAAU";
    $OCCode = "a1b5f000000eT4PAAU";
    $SDCode = "a1b5f000000eT8bAAE";
    $SMCode = "a1b5f000000eT8gAAE";
    $CHCode = "a1b5f000000enBnAAI";
    // $NCode = "a1b5f000000eT4OAAU"; TODAVIA NO HAY CODIGO
    // $SBCode = "a1b5f000000eT4OAAU"; TODAVIA NO HAY CODIGO

    switch ($locationArg) { //IN-PERSON (Falta chicago, san berdandino, National)
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

    return $code;
}

// Function to redirect to Virtual
function redirectsVirtual($loctionType, $locationCode, $nameArg, $lastNameArg, $emailArg, $numberArg, $locationArg, $languageArg)
{
    $redirectLink = "https://greencardla.my.site.com/s/onlinescheduler?processId=a1h5f000000nAJZAA2&locationtype=" . $loctionType . "&WhatId=a1n5f0000006fzTAAQ&WhereID=" . $locationCode . "&sumoapp_WhoId=0055f000007NE9T" . "&a2=" . $nameArg . "&a3=" . $lastNameArg . "&a5=" . $emailArg . "&a6=" . $numberArg . "&a8=" . $locationArg . "&a9=" . $languageArg;
    return $redirectLink;
}

// Function to redirect to In-Person
function redirects($loctionType, $locationCode, $nameArg, $lastNameArg, $emailArg, $numberArg, $locationArg, $languageArg)
{
    $redirectLink = "https://greencardla.my.site.com/s/onlinescheduler?processId=a1h5f000000nAJCAA2&locationtype=" . $loctionType . "&WhatId=a1n5f0000006fzTAAQ&WhereID=" . $locationCode . "&sumoapp_WhoId=0055f000007NE9T" . "&a2=" . $nameArg . "&a3=" . $lastNameArg . "&a5=" . $emailArg . "&a6=" . $numberArg . "&a8=" . $locationArg . "&a9=" . $languageArg;
    return $redirectLink;
}

// Necesita de los links en strig $strNAme, $stremail, etc ...
function getLink($meetingTypeArg, $code, $strName, $strlastName, $stremail, $strnumber, $strlocation, $strlanguage)
{
    // Location type
    $locationT = "";
    $phone = "VID_CONFERENCE";
    $person = "OUR_LOCATION";

    if ($meetingTypeArg == $person) { //Person
        $locationT = strval($person);
        $link = redirects($locationT, $code, $strName, $strlastName, $stremail, $strnumber, $strlocation, $strlanguage);
        return $link;
    } else { //Phone
        $locationT = strval($phone);
        $link = redirectsVirtual($locationT, $code, $strName, $strlastName, $stremail, $strnumber, $strlocation, $strlanguage);
        return $link;
    }
    
    $linkRedirect = getLink($meetingTypeP, $code, $strName, $strlastName, $stremail, $strnumber, $strlocation, $strlanguage);

    return $link;
}

// INICIO DE LA OBTENCION DEL LINK
try {
  // Data from Form on index.html
  $name = $_POST['first_name'];
  $lastName = $_POST['last_name'];
  $email = $_POST['email'];
  $number = $_POST['mobile'];
  $question = $_POST['message'];
  $location = $_POST['00N5f00000SB1X0'];
  $language = $_POST['00N5f00000SB1Ws'];
  $sms = $_POST['00N5f00000SB1XU'];
  $meetingTypeP = $_POST['meetingType'];

  // Convert imputs to String
  $strName = strval($name);
  $strlastName = strval($lastName);
  $stremail = strval($email);
  $strnumber = strval($number);
  $strquestion = strval($question);
  $strlocation = strval($location);
  $strlanguage = strval($language);
  $strsms = strval($sms);

  $code = getLocation($location); //Llamado de la function

//   $data = getLocation($strlocation);

  $linkRedirect = getLink($meetingTypeP, $code, $strName, $strlastName, $stremail, $strnumber, $strlocation, $strlanguage);


  echo $linkRedirect;
//   echo $code;

//   sendEmail();

//   $newlink = sendEmail($language, $email, $name, $lastName, $number, $question, $linkRedirect);
//   print strval($newlink);

    
} catch (Exception $e) {
    header("Location: https://ericp138.sg-host.com/sorry.html"); // <--- show this site when something is wrong
}
