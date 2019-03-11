<?php
namespace DTA\DHT11\Model;

use DTA\DHT11\Model\Measure;
use DTA\DHT11\Model\DHT11_DbManager;
use \PDO as PDO;

class ApiMeasureManager {
    private $dbManager;
    private $lastEntryData;
    private $measures;
    private $avgTemp;
    
    function __construct() {
        $this->dbManager = new DHT11_DbManager();
        $this->measures = array();
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
                "data" => $measure->getDate()
            );
            $i++;
        }
        
        return json_encode($this->measures);
    }

}

