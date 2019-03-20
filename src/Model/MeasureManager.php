<?php
namespace DTA\DHT11\Model;

use DTA\DHT11\Model\Measure;
use DTA\DHT11\Model\DHT11_DbManager;
use \PDO as PDO;

//this is only use by StoreController (for NodeMCU sending data)

class MeasureManager {
    private $dbManager;
    private $lastEntryData;
    private $measures;
    private $avgTemp;

    function __construct() {
        $this->dbManager = new DHT11_DbManager();
        $this->measures = array();
    }

    private function createDHT11Table() {
        $req =$this->dbManager->db->exec("
    CREATE DATABASE IF NOT EXISTS `DHT11_db`
    CHARSET=utf8
    COLLATE utf8_general_ci;
    USE DHT11_db;
    CREATE TABLE IF NOT EXISTS `entries` (
    `key` int(11) NOT NULL AUTO_INCREMENT,
    `date` varchar(45) NOT NULL,
    `temperature` SMALLINT NOT NULL,
    `humidity` tinyint NOT NULL,
    PRIMARY KEY (`key`)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ");
        $req = null;
    }

    public function insertNewMeasure(Measure $measure) {
        $this->createDHT11Table();

        $req = $this->dbManager->db->prepare('
              USE DHT11_db;
              INSERT INTO entries (date, temperature, humidity)
              VALUES (:date, :temperature, :humidity);
        ');
        try {
            $req->execute(array(
                ':date'=>$measure->getDate(),
                ':temperature'=>$measure->getTemperature(),
                ':humidity'=>$measure->getHumidity()
            ));
        }
        catch (PDOException $e) {
            die("Erreur: ".$e->getMessage());
        }
    }
}
