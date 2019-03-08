<?php
$lastEntry = $this->lastMeasure;
$allEntries = $this->allMeasures;
$mymercure = 123 + $lastEntry['lastTemp'] * 2.40;
$rangeStartDate = $this->rangeStartDate;
$rangeEndDate = $this->rangeEndDate;
$avgTemp = $this->avgTemp;
$avgHum = $this->avgHum;
$maxTemp = $this->maxTemp;
$minTemp = $this->minTemp;
$maxHum = $this->maxHum;
$minHum = $this->minHum;

$previsionData = $this->previsionData;

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
        <hr>
        <div>
        	<h2>Prévisions <?= $previsionData["locality"]; ?></h2>
          		<form method="get" action="http://51.75.126.56/DHT11/index.php">
<!--         	<form method="get" action="http://localhost/eclipse-workspace/DHT11/index.php"> -->
        		<input type="text" name="locality" placeholder=<?= $previsionData["locality"]; ?>>
        		<input type="hidden" name="c" value="measure"><input type="submit" value="send">
        	</form>
        	<br>
        	<table class="table table-bordered table-dark table-hover">
        		<tr>
        			<th>Date</th>
        			<th>Condition</th>
        			<th>Minimum temperature</th>
        			<th>Maximum temperature</th>
        		</tr>
        		<?php foreach($previsionData["days"] as $day) { ?>
        		
        		<tr>
        			<td><?= $day["date"] ?></td>
        			<td><img src=<?= $day["icon"] ?>><?= $day["condition"] ?></td>
        			<td><?= $day["tempMin"] ?> °C</td>
        			<td><?= $day["tempMax"] ?> °C</td>
        		</tr>
        		
        		<?php } ?>
        		
        	</table>
        </div>
        <hr>
        <h2>DHT11 station</h2>
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
          <form method="get" action="http://51.75.126.56/DHT11/index.php">
<!--           <form method="get" action="http://localhost/eclipse-workspace/DHT11/index.php"> -->
          	<div class="form-group">
          		<label>Range start :</label>
          		<input type="date" class="form-control" name="range_start" value=<?= $rangeStartDate?> >
          		<label>Range end : </label>
          		<input type="date" class="form-control" name="range_end" value=<?= $rangeEndDate?> >
          		<input type="hidden" name="c" value="measure">
          	</div>
          	<div class="form-group">
          		<input class="btn btn-success form-control" type="submit" value="check">
          	</div>
          </form>
            <table class="table table-bordered">
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
            <hr>
            <h4>Stats :</h4>
            <em>Range: from <?= $rangeStartDate?> to <?= $rangeEndDate?> </em>
            <br><br>
            <table class="table table-bordered">
            	<tr>
            		<th colspan="3" >Temperature :</th>
            	</tr>
            	<tr>
            		<th>min</th>
            		<th>max</th>
            		<th>average</th>
            	</tr>
            	<tr>
            		<td><?= $minTemp ?> °C</td>
            		<td><?= $maxTemp ?> °C</td>
            		<td><?= $avgTemp ?> °C</td>
            	</tr>
            	
            	<tr><th colspan="3">Humidity :</th></tr>
            	<tr>
            		<th>min</th>
            		<th>max</th>
            		<th>average</th>
            	</tr>
            	<tr>
            		<td><?= $minHum ?> %</td>
            		<td><?= $maxHum ?> %</td>
            		<td><?= $avgHum ?> %</td>
            	</tr>
            </table>
          </section>
          <section id="graphSection">
          	<div id="chartGraph"></div>
          </section>
        </main>
    </body>
</html>