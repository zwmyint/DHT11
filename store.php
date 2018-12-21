<?php
// if (isset($_POST['temperature']) && isset($POST['humidite'])) {
//   $new_tmp = $_POST['temperature'];
//   $new_hum = $_POST['humidite'];
//   $json_data = '{"temperature":'.$new_tmp .','.'"humidite":'.$new_hum.'}';
// }

$myFile = 'data.txt';
$new_json = file_get_contents("php://input");
//
// verif donnée - renvoi des erreurs possibles
$data = json_decode($new_json);
if (!$data) {
    http_response_code(415);
    exit();
} elseif (!$data->temperature || !$data->humidite) {
    http_response_code(400);
    exit();
}
file_put_contents($myFile, $new_json);

if (!$new_json) {
    http_response_code(500);
    exit();
}
