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
                height: 10px;
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
        <p id="infoMsg">Il fait <span id="tmp"></span>°C avec <span id="wet"></span>% d'humidité.<br>
        Le <span id="date"></span> à <span id = "hour"></span></p>
        <div id="thermo">
            <img src="thermo.jpg" height=400>
            <div id="mercure"></div>
        </div>
        
    </body>
</html>
