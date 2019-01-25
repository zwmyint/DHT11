<?php
require_once "../Model/MeasureManager.php";
require_once "../Model/Measure.php";

$myFile = 'data.txt';
$new_json = file_get_contents("php://input");

$data = json_decode($new_json);
if (!$data) {
    http_response_code(415);
    exit();
} elseif (!$data->temperature || !$data->humidity) {
    http_response_code(400);
    exit();
}

if (!$new_json) {
    http_response_code(500);
    exit();
}

writeData($myFile, $new_json);

function writeData($file, $json) {//write in txt file and DB
  require_once "../Model/pdoConfig.php";
  file_put_contents($file, $json);
  $json_data = json_decode($json);
  $temp = $json_data->temperature;
  $hum = $json_data->humidity;
  $date = date('\l\e Y-m-d \à H:i:s');
  $measure = new Measure($date, $temp, $hum);
  $measureManager = new MeasureManager($host, $username, $password);
  $measureManager->insertNewEntry($measure);
}
