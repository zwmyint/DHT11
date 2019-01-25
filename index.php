<?php
require_once('read.php');
$data = readData();
$mymercure = 123 + $data['lastTemp'] * 2.40;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link href='' rel='stylesheet' type='text/css'>
        <title>Exo affichage température</title>
        <style>
            #mercure {
                position: absolute;
                background-color: red;
                width: 8px;
                height: <?php echo $mymercure ?>px;
                bottom: 85px;
                left: 44px;
            }
            #thermo {
                position: relative;
            }
        </style>
    </head>
    <body>
        <h1>Température</h1>
        <p id="infoMsg">Il fait <span id="tmp"><?= $data['lastTemp']?></span>°C avec <span id="wet"><?= $data['lastHum']?></span>% d'humidité.<br>
        Le <span id="date"><?= $data['lastDate']?></span></p>
        <div id="thermo">
            <img src="thermo.jpg" height=400>
            <div id="mercure"></div>
        </div>
    </body>
</html>
