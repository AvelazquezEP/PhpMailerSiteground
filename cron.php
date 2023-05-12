<?php

session_start();
$newToken = $_SESSION["newKey"]; //<--- este siempre se actualiza a las 5 am/pm

try {
    // // Parameters
    // $typeRequest = "refresh_token";
    // $client_id = "3MVG9p1Q1BCe9GmCTLOrzG0fy.Avu0cWom1hzgSzlZpvn.md7wGghadvLfkDKFVcYzeeeA7S23b8emt5JCbIq";
    // $secret_id = "67EE826292B731BD3EB70D7780FA9BE7A7055E9D066E31C7805319CE549441AC";
    // $refresh_token = "5Aep861FpKlGRwv8KAiV.sa3q6sPXVzio_hrVzMwc15tmOyIN1R2WLBImVQQKuEEVVij7ZAaKv.TLzVsmVcJDtz";

    // $response = refreshAccessToken($typeRequest, $client_id, $secret_id, $refresh_token);
    // // $response = refreshAccessToken();

    // echo $response;
    // // var_dump($response);
    
    $temporal_refresh_token = '5Aep861FpKlGRwv8KAiV.sa3q6sPXVzio_hrVzMwc15tmOyIN1R2WLBImVQQKuEEVVij7ZAaKv.TLzVsmVcJDtz';
    $tokenUpdated = "";
    // Parameters

    if ($temporal_refresh_token != $newToken) {
        $refresh_token = $temporal_refresh_token;
    }

    $typeRequest = "refresh_token";
    $client_id = "3MVG9p1Q1BCe9GmCTLOrzG0fy.Avu0cWom1hzgSzlZpvn.md7wGghadvLfkDKFVcYzeeeA7S23b8emt5JCbIq";
    $secret_id = "67EE826292B731BD3EB70D7780FA9BE7A7055E9D066E31C7805319CE549441AC";

    $response = refreshAccessToken($typeRequest, $client_id, $secret_id, $refresh_token);
    // $response = refreshAccessToken();

    $_SESSION["newKey"] = $response;
    var_dump($response);
} catch (Exception $e) {
    echo "Error: " . $e;
}

// function refreshAccessToken()
function refreshAccessToken($typeRequest, $client_id, $secret_id, $refresh_token)
{
    $urlApi = 'https://login.salesforce.com/services/oauth2/token';

    $dataArray = [
        'grant_type' => $typeRequest,
        'client_id' => $client_id,
        'client_secret' => $secret_id,
        'refresh_token' => $refresh_token
    ];

    $curl = curl_init($urlApi);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($dataArray));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    $jsonArrayResponse = json_decode($result);
    curl_close($curl); //Esta linea puede que ocasione tomar algunos segundos extras si tarda demasiado considerar COMENTAR/eliminar

    // return $result;
    return $jsonArrayResponse;
}
