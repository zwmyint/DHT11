<?php
//if (isset($_POST['temp']) && isset($_POST['hum'])) {
//    $myFile = 'data.txt';
//    $new_temp = $_POST['temp'];
//    $new_hum = $_POST['hum'];
//    $myjsondata = file_get_contents($myFile);
//    $mydata = json_decode($myjsondata);
//    $mydata->temperature = $new_temp;
//    $mydata->humidite = $new_hum;
//    $myNewJson = json_encode($mydata);
//    file_put_contents($myFile, $myNewJson);
//}
//header('Location: index.php');

//if (isset($_POST['data'])) {
//    $myFile = 'data.txt';
//    $new_data = $_POST['data'];
//    file_put_contents($myFile, $new_data);
//    echo file_get_contents($myFile);
//}
//header('Location: index.php');

$myFile = 'data.txt';
$new_json = file_get_contents("php://input");

//verif donnée - renvoi des erreurs possibles
$data = json_decode($new_json);
if (!$data) {
    http_response_code(415);
    exit();
} elseif (!$data->temperature || !$data->humidite) {
    http_response_code(400);
    exit();
}
file_put_contents($myFile, $new_json);

if (!$new_data) {
    http_response_code(500);
    exit();
}

header('Location: index.php');