<?php
if (isset($_POST['temperature']) && isset($POST['humidite'])) {
  $new_tmp = int($_POST['temperature']);
  $new_hum = int($_POST['humidite']);
  $json_data = '{"temperature":'.$new_tmp .','.'"humidite":'.$new_hum.'}';
}

$myFile = 'data.txt';
// $new_json = file_get_contents("php://input");
//
// verif donnée - renvoi des erreurs possibles
$data = json_decode($json_data);
if (!$data) {
    http_response_code(415);
    exit();
} elseif (!$data->temperature || !$data->humidite) {
    http_response_code(400);
    exit();
}
file_put_contents($myFile, $json_data);

if (!$json_data) {
    http_response_code(500);
    exit();
}
