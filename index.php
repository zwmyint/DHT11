<?php
$myjsondata = file_get_contents('data.txt');
$mydata = json_decode($myjsondata);
$mydate = date('d/m/Y');
$myhour = date('H:i:s');
$mymercure = 123 + $mydata->temperature * 2.40;
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
        <p id="infoMsg">Il fait <span id="tmp"><?php echo $mydata->temperature ?></span>°C avec <span id="wet"><?php echo $mydata->humidite ?></span>% d'humidité.<br>
        Le <span id="date"><?php echo $mydate ?></span> à <span id = "hour"><?php echo $myhour ?></span></p>
        <div id="thermo">
            <img src="thermo.jpg" height=400>
            <div id="mercure"></div>
        </div>  
    </body>
</html>
