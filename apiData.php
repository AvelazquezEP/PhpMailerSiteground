<?php

session_start();

try {
    $firstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $Email = $_POST['Email'];
    $mobile_phone = $_POST['MobilePhone'];
    $location_name = $_POST['Location__c'];
    $Language_site = $_POST['Language__c'];
    $sms_option = $_POST['SMS_Opt_In__c'];

    $response =  createLeadApi( $firstName, $LastName, $Email, $mobile_phone, $location_name, $Language_site, $sms_option);

    // var_dump($response);
    echo $response;
} catch (Exception $e) {
    header("Location: https://ericp138.sg-host.com/sorry.html");    // <--- show this site when something is wrong    
}

// FUNCTIONS SECTIONS
function createLeadApi($first_name, $last_name, $email, $mobile_phone, $location_name, $language_site, $sms_option) {

    $Token = getLastToken();
    $newToken = $Token->new_token;

    $urlApi = 'https://greencardla.my.salesforce.com/services/data/v57.0/sobjects/Lead';
    // $authorization = "Authorization: Bearer 00D5f000006OVX8!ARcAQAVcy1d2L4sPQPBqsvBoiL13tyFNS.rErqX9HCCXlfio7H2cShqeXhOlc88ybD6KhyL.5py6sqV2KHC33wQ8w4EMr7qA";
    $authorization = "Authorization: Bearer " . $newToken;

    $dataArray = [
        'FirstName' => $first_name,
        'LastName' => $last_name,
        'Email' => $email,
        'LeadSource' => "EP-CA-Website",
        'MobilePhone' => $mobile_phone,
        'Location__c' => $location_name,
        'Language__c' => $language_site,
        'SMS_Opt_In__c' => $sms_option
    ];

    $ch = curl_init($urlApi);
    $payload = json_encode($dataArray);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    $jsonArrayResponse = json_decode($result);
    curl_close($ch);

    return $result;    
}

function getLastToken()
{
    // include_once('connection.inc.php');
    $host = "ericp138.sg-host.com";
    $port = "5432";
    $dbname = "dbhxe3qcvkv7wx";
    $user = "uexeeqopvpkgb";
    $password = "9gXq&(jy1)b4";

    $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
    $dbconn = pg_connect($connection_string) or die('Could not reach database.');

    $sql = "select id_token, new_token from tokenacess order by id_token desc limit 1";
    $result = pg_query($sql);
    return pg_fetch_object($result);
}
