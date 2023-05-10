<?php

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
function getLeads($mail)
{
    // $urlApi = 'https://greencardla.my.salesforce.com/services/data/v57.0/query/?q=SELECT+email+from+Lead';    
    $urlApi = 'https://greencardla.my.salesforce.com/services/data/v57.0/search/?q=FIND+%7B' . $mail . '%7D';
    $authorization = "Authorization: Bearer 00D5f000006OVX8!ARcAQIxE1YdCJSv0axUnIjimcYRe1J2s0cee_opDbOvd24No1i4kH63pxdpRmJxtpYdIS8q65kqh9feonpNvDaJzFYG3AQ_Z";

    $cURLConnection = curl_init();
    curl_setopt($cURLConnection, CURLOPT_URL, $urlApi);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($cURLConnection, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($cURLConnection, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($cURLConnection, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization));
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
    $leadList = curl_exec($cURLConnection);
    $jsonArrayResponse = json_decode($leadList);
    curl_close($cURLConnection);

    // return $leadList;
    return $jsonArrayResponse;
}

function createLeadApi($first_name, $last_name, $email, $mobile_phone, $location_name, $language_site, $sms_option) {
    $urlApi = 'https://greencardla.my.salesforce.com/services/data/v57.0/sobjects/Lead';
    $authorization = "Authorization: Bearer 00D5f000006OVX8!ARcAQJjlAN8d227IS_vgzGkjbimTGnZgz4PBb3WDfdd12RxvUJRdiCZ.lnFvzvbgxQxfDy9rgdle7gcgUgq3i5WvVR.fuy56";

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