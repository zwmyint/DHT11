<?php
namespace DTA\DHT11\Model;

use DTA\DHT11\Model\Measure;
use DTA\DHT11\Model\DHT11_DbManager;
use \PDO as PDO;

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

    public function getLastMeasure() {
        $req = $this->dbManager->db->query("
          SELECT date, temperature, humidity
          FROM DHT11_db.entries ORDER BY `key` DESC LIMIT 1;
        ");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $result = $req->fetch();
        $this->lastEntryData = array(
            'lastDate'=>$result['date'],
            'lastTemp'=>$result['temperature'],
            'lastHum'=>$result['humidity']
        );
        return $this->lastEntryData;
    }
    
    public function getAllMeasures() {
        $req = $this->dbManager->db->query('
          SELECT `date`, `temperature`, `humidity`
          FROM DHT11_db.entries;
        ');
        $req->setFetchMode(PDO::FETCH_ASSOC);
        while ($row = $req->fetch()) {
            $measure = new Measure($row['date'], $row['temperature'], $row['humidity']);
            array_push($this->measures, $measure);
        }
        return $this->measures;
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
        while ($row = $req->fetch()) {
            $measure = new Measure($row['date'], $row['temperature'], $row['humidity']);
            array_push($this->measures, $measure);
        }
        return $this->measures;
    }

    public function getAvgTemp($startDate, $endDate) {
        $sDate = "le ".$startDate." à 00:00:00";
        $eDate = "le ".$endDate." à 00:00:00";
        $req = $this->dbManager->db->prepare('
            SELECT AVG(`temperature`) AS `avgTemp`
            FROM DHT11_db.entries
            WHERE `date`
            BETWEEN :startDate AND :endDate;
        ');
        $req->execute(array(
            ':startDate'=>$sDate,
            ':endDate'=>$eDate
        ));
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $avg = $req->fetch() ;
        return $avg['avgTemp'];

    }

    public function getAvgHum($startDate, $endDate) {
        $sDate = "le ".$startDate." à 00:00:00";
        $eDate = "le ".$endDate." à 00:00:00";
        $req = $this->dbManager->db->prepare('
            SELECT AVG(`humidity`) AS `avgHum`
            FROM DHT11_db.entries
            WHERE `date`
            BETWEEN :startDate AND :endDate;
        ');
        $req->execute(array(
            ':startDate'=>$sDate,
            ':endDate'=>$eDate
        ));
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $avg = $req->fetch() ;
        return $avg['avgHum'];
    }

    public function getMaxTemp($startDate, $endDate) {
        $sDate = "le ".$startDate." à 00:00:00";
        $eDate = "le ".$endDate." à 00:00:00";
        $req = $this->dbManager->db->prepare('
            SELECT MAX(`temperature`) AS `maxTemp`
            FROM DHT11_db.entries
            WHERE `date`
            BETWEEN :startDate AND :endDate;
        ');
        $req->execute(array(
            ':startDate'=>$sDate,
            ':endDate'=>$eDate
        ));
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $avg = $req->fetch() ;
        return $avg['maxTemp'];
    }

    public function getMinTemp($startDate, $endDate) {
        $sDate = "le ".$startDate." à 00:00:00";
        $eDate = "le ".$endDate." à 00:00:00";
        $req = $this->dbManager->db->prepare('
            SELECT MIN(`temperature`) AS `minTemp`
            FROM DHT11_db.entries
            WHERE `date`
            BETWEEN :startDate AND :endDate;
        ');
        $req->execute(array(
            ':startDate'=>$sDate,
            ':endDate'=>$eDate
        ));
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $avg = $req->fetch() ;
        return $avg['minTemp'];
    }

    public function getMaxHum($startDate, $endDate) {
        $sDate = "le ".$startDate." à 00:00:00";
        $eDate = "le ".$endDate." à 00:00:00";
        $req = $this->dbManager->db->prepare('
            SELECT MAX(`humidity`) AS `maxHum`
            FROM DHT11_db.entries
            WHERE `date`
            BETWEEN :startDate AND :endDate;
        ');
        $req->execute(array(
            ':startDate'=>$sDate,
            ':endDate'=>$eDate
        ));
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $avg = $req->fetch() ;
        return $avg['maxHum'];
    }

    public function getMinHum($startDate, $endDate) {
        $sDate = "le ".$startDate." à 00:00:00";
        $eDate = "le ".$endDate." à 00:00:00";
        $req = $this->dbManager->db->prepare('
            SELECT MIN(`humidity`) AS `minHum`
            FROM DHT11_db.entries
            WHERE `date`
            BETWEEN :startDate AND :endDate;
        ');
        $req->execute(array(
            ':startDate'=>$sDate,
            ':endDate'=>$eDate
        ));
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $avg = $req->fetch() ;
        return $avg['minHum'];
    }
}
