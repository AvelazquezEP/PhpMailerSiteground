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

    $accessToken = $_SESSION["newKey"]; //<--Obtengo el token
    $new_access_token = strval($accessToken->access_token);
    $token = $new_access_token;

    $urlApi = 'https://greencardla.my.salesforce.com/services/data/v57.0/sobjects/Lead';
    $authorization = "Authorization: Bearer 00D5f000006OVX8!ARcAQBvqw5_ZQWz9OU_kuU7LZ6ZClrwxx_kxZQnba0U6WL.cEIhU3fqYWECB6UlNxus7KBcFISPgF.QrJqh6xsJ7uINzp21c";
    // $authorization = "Authorization: Bearer " . $token;

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