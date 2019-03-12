<?php
namespace DTA\DHT11\Model;

use DTA\DHT11\Model\Measure;
use DTA\DHT11\Model\DHT11_DbManager;
use \PDO as PDO;

class ApiMeasureManager {
    private $dbManager;
    private $measures;

    function __construct() {
        $this->dbManager = new DHT11_DbManager();
        $this->measures = array(
          "measures"=>array(),
          "avgTemp"=>0,
          "avgHum"=>0,
          "maxTemp"=>0,
          "minTemp"=>0,
          "maxHum"=>0,
          "minHum"=>0
        );
    }

    public function getAllMeasures() {
        $req = $this->dbManager->db->query('
          SELECT `date`, `temperature`, `humidity`
          FROM DHT11_db.entries;
        ');

        $req->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;
        while ($row = $req->fetch()) {
            $measure = new Measure($row['date'], $row['temperature'], $row['humidity']);
            $key = $i;
            $this->measures["measures"][$key] =  array(
                "temperature" => $measure->getTemperature(),
                "humidity" => $measure->getHumidity(),
                "date" => $measure->getDate()
            );
            $i++;
        }

        return json_encode($this->measures);
    }

    public function getMeasuresInRange($startDate, $endDate) {

        $sDate = "le ".$startDate." à 00:00:00";
        $eDate = "le ".$endDate." à 00:00:00";

        $req = $this->dbManager->db->prepare('
            SELECT `date`, `temperature`, `humidity`
            FROM DHT11_db.entries
            WHERE `date` BETWEEN :startDate
            AND :endDate;
        ');
        $req->execute(array(
            ':startDate'=>$sDate,
            ':endDate'=>$eDate
        ));
        $req->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;
        while ($row = $req->fetch()) {
            $measure = new Measure($row['date'], $row['temperature'], $row['humidity']);
            $key = $i;
            $this->measures["measures"][$key] =  array(
                "temperature" => $measure->getTemperature(),
                "humidity" => $measure->getHumidity(),
                "date" => $measure->getDate()
            );
            $i++;
        }

        $avgTemp = 0;
        $minTemp ='';
        $maxTemp ='';
        $sumTemps = 0;
        $countTemps = 0;
        foreach ($this->measures["measures"] as $measure) {

            $sumTemps += $measure["temperature"];

            if ($measure["temperature"] < $minTemp || empty($minTemp)) {
              $minTemp = $measure["temperature"];
            }
            if ($measure["temperature"] > $maxTemp || empty($maxTemp)) {
              $maxTemp = $measure["temperature"];
            }

            $countTemps++;
        }
        if (!$countTemps == 0) {
            $avgTemp = $sumTemps / $countTemps;
        }
        $this->measures["avgTemp"] = $avgTemp;
        $this->measures["maxTemp"] = $maxTemp;
        $this->measures["minTemp"] = $minTemp;

        $avgHum = 0;
        $minHum ='';
        $maxHum ='';
        $sumHums = 0;
        $countHums = 0;
        foreach ($this->measures["measures"] as $measure) {

            $sumHums += $measure["humidity"];

            if ($measure["humidity"] < $minHum || empty($minHum)) {
              $minHum = $measure["humidity"];
            }
            if ($measure["humidity"] > $maxHum || empty($maxHum)) {
              $maxHum = $measure["humidity"];
            }

            $countHums++;
        }
        if (!$countHums == 0) {
            $avgHum = $sumHums / $countHums;
        }
        $this->measures["avgHum"] = $avgHum;
        $this->measures["maxHum"] = $maxHum;
        $this->measures["minHum"] = $minHum;


        return json_encode($this->measures);
    }

}
