<!-- CRON FILE / 2 TIMES X DAY (5 AM/PM) -->
<?php

session_start();
$newToken = $_SESSION["newKey"]; //<--- este siempre se actualiza a las 5 am/pm

try {

    $typeRequest = "refresh_token";
    $client_id = "3MVG9p1Q1BCe9GmCTLOrzG0fy.Avu0cWom1hzgSzlZpvn.md7wGghadvLfkDKFVcYzeeeA7S23b8emt5JCbIq";
    $secret_id = "67EE826292B731BD3EB70D7780FA9BE7A7055E9D066E31C7805319CE549441AC";
    $refresh_token = '5Aep861FpKlGRwv8KAiV.sa3q6sPXVzio_hrVzMwc15tmOyIN1R2WLBImVQQKuEEVVij7ZAaKv.TLzVsmVcJDtz';

    $response = refreshAccessToken($typeRequest, $client_id, $secret_id, $refresh_token);

    $newToken = $response->access_token;
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

    $new_token = strval($jsonArrayResponse->access_token);

    $date = date('Y-m-d H:i:s.uO');

    saveToken($new_token, $date);

    return $jsonArrayResponse;
}



function saveToken($tokenString, $dateToken)
{
    // include_once('connection.inc.php');
    $host = "ericp138.sg-host.com";
    $port = "5432";
    $dbname = "dbhxe3qcvkv7wx";
    $user = "uexeeqopvpkgb";
    $password = "9gXq&(jy1)b4";

    $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
    $dbconn = pg_connect($connection_string) or die('Could not reach database.');

    // $table_name = 'tokenacess';

    // INSERT INTO PUBLIC.juntas(dateof,topic,description) VALUES(24/05/2023, "Pokemon", "Pikachu is the choice for the best pokemon in this meet");
    // $sql = "INSERT INTO PUBLIC." . $this->table_name . "(dateof,topic,description) " . "VALUES('" . $this->cleanData($_POST['dateof']) . "','" . $this->cleanData($_POST['topic']) . "','" . $this->cleanData($_POST['description']) . "')";
    $sql = "INSERT INTO tokenacess(new_token, newToken_date) " . "VALUES('" . cleanData($tokenString) . "','" . cleanData($dateToken) . "')";
    // $sql = "INSERT INTO tokenacess(new_token, newToken_date, old_token) " . "VALUES('" . cleanData($tokenString) . "','" . cleanData($dateToken) . "','" . cleanData($dateToken) . "')";
    return pg_affected_rows(pg_query($sql));
}

function cleanData($val)
{
    return pg_escape_string($val);
}
