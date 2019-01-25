<?php
class DHT11_DbManager {
  private $host;
  private $username;
  private $password;
  private $db;
  private $lastEntryData;

  function __construct($host, $username, $password) {
    $this->host = $host;
    $this->username = $username;
    $this->password = $password;
    $this->connect();
  }

  private function connect() {
    try {
      $this->db = new PDO("mysql:host=$this->host;charset=utf8", $this->username, $this->password);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return "Connecté à ".$this->host." avec succès.";
    }
    catch (PDOException $e) {
      die("Error while connecting to database : ".$e->getMessage());
    }
  }

  private function createDHT11Table() {
    $req =$this->db->exec("
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

  public function insertNewEntry($date, $temp, $hum) {
    $this->createDHT11Table();

    $req = $this->db->prepare('
      USE DHT11_db;
      INSERT INTO entries (date, temperature, humidity)
      VALUES (:date, :temperature, :humidity);
    ');
    try {
      $req->execute(array(
        ':date'=>$date,
        ':temperature'=>$temp,
        ':humidity'=>$hum
      ));
    }
    catch (PDOException $e) {
      die("Erreur: ".$e->getMessage());
    }
  }

  public function getLastEntry() {
    $req = $this->db->query("
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
}
