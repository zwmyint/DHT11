<?php
require_once "DbManager.php";
require_once "pdoConfig.php";

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
if (!$new_json) {
    http_response_code(500);
    exit();
}

writeData($myFile, $new_json);

function writeData($file, $json) {//write in file and database
  file_put_contents($file, $json);
  $json_data = json_decode($json);
  $temp = $json_data->temperature;
  $hum = $json_data->humidity;
  $date = date('\l\e Y-m-d \à H:i:s');
  $dbManager = new DbManager($host, $db, $username, $password);
  $dbManager->connect();
  $dbManager->insertNewEntry($date, $temp, $hum);
}
