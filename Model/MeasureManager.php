<?php
require_once('Measure.php');
require_once('DHT11_DbManager.php');

class MeasureManager {
  private $dbManager;
  private $lastEntryData;
  private $measures;
  private $host;
  private $username;
  private $password;

  function __construct($host, $username, $password) {

    $this->dbManager = new DHT11_DbManager($host, $username, $password);
    $this->measures = array();
    $this->host = $host;
    $this->username = $username;
    $this->password = $password;
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

  public function insertNewEntry(Measure $measure) {
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

  public function getLastEntry() {
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
}
