<?php

try {
    // Parameters
    $typeRequest = "refresh_token";
    $client_id = "3MVG9p1Q1BCe9GmCTLOrzG0fy.AtVdjI1bpjsXk75auD66yttNZCS1sxFeaWP.FXhkKFeEwGFxgwWHd7KzpbL";
    $secret_id = "97CF2DC58420713117B6F75224883587473D3F824D5242255930888121576DA6";
    $refresh_token = "5Aep861FpKlGRwv8KAiV.sa3q6sPXVzio_hrVzMOeBTFW8mUbaSomOmD_avF.eYinv_xdHnHP_BkDi._a4qprR_";

    $response = refreshAccessToken($typeRequest, $client_id, $secret_id, $refresh_token);
    // $response = refreshAccessToken();

    echo $response;
    // var_dump($response);
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

    return $result;    
}
