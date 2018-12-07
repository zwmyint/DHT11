<?php
if (isset($_POST['temp']) && isset($_POST['hum'])) {
    $myFile = 'data.txt';
    $new_temp = $_POST['temp'];
    $new_hum = $_POST['hum'];
    $myjsondata = file_get_contents($myFile);
    $mydata = json_decode($myjsondata);
    $mydata->temperature = $new_temp;
    $mydata->humidite = $new_hum;
    $myNewJson = json_encode($mydata);
    file_put_contents($myFile, $myNewJson);
}
header('Location: index.php');