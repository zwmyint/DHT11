<?php
$lastEntry = $this->lastMeasure;
$allEntries = $this->allMeasures;
$mymercure = 123 + $lastEntry['lastTemp'] * 2.40;

$temperatures = [];
$humidities = [];
$dates = [];

foreach ($allEntries as $measure) {
    array_push($temperatures, $measure->getTemperature());
    array_push($humidities, $measure->getHumidity());
    array_push($dates, $measure->getDate());
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link href='src/static/style/style.css' rel='stylesheet'>
        <title>DHT11 project</title>
        <style>
            #mercure {
                position: absolute;
                background-color: red;
                width: 8px;
                height: <?= $mymercure ?>px;
                bottom: 85px;
                left: 44px;
            }
            #thermo {
                position: relative;
            }
        </style>
        <script>
            let temperatures = <?php echo json_encode($temperatures) ?>;
            let humidities = <?php echo json_encode($humidities) ?>;
            let dates = <?php echo json_encode($dates) ?>;
        </script>
        <script src = "https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <script src="src/static/js/graph.js"></script>
    </head>
    <body>
        <h1>DHT11 meteo center</h1>
        <main>
          <section id="thermometerSection">
            <p id="infoMsg">Il fait <span id="tmp"><?= $lastEntry['lastTemp']?></span>°C avec <span id="wet"><?= $lastEntry['lastHum']?></span>% d'humidité.<br>
            <span id="date"><?= $lastEntry['lastDate']?></span></p>
            <div id="thermo">
                <img src="src/static/img/thermo.png" height=400>
                <div id="mercure"></div>
            </div>
          </section>

          <section id="entriesTableSection">
            <table>
              <tr>
                <th>
                  Date
                </th>
                <th>
                  Temperature
                </th>
                <th>
                  Humidity
                </th>
              </tr>
              <?php foreach ($allEntries as $entry) { ?>
              <tr class="entryRow">
                <td class="entryData">
                    <?= $entry->getDate() ?>
                </td>
                <td class="entryData">
                    <?= $entry->getTemperature() ?>
                </td>
                <td class="entryData">
                    <?= $entry->getHumidity() ?>
                </td>
              </tr>
              <?php } ?>
            </table>
          </section>
          <section id="graphSection">
          	<div id="chartGraph"></div>
          </section>
        </main>
    </body>
</html>