<?php
class DHT11_DbManager {
  private $host;
  private $username;
  private $password;
  private $db;

  function __construct($host, $username, $password) {
    $this->host = $host;
    $this->username = $username;
    $this->password = $password;
  }

  public function connect() {
    try {
      $this->db = new PDO("mysql:host=$this->host;charset=utf8", $this->username, $this->password);
      return "Connecté à ".$this->host." avec succès.";
    }
    catch (PDOException $e) {
      die("Error while connecting to database : ".$e->getMessage());
    }
  }

  private function createDHT11Table() {
    $req =$this->db->query("
    CREATE DATABASE  IF NOT EXISTS `DHT11_db`
    USE `DHT11_db`;
    CREATE TABLE `entries` (
    `key` int(11) NOT NULL AUTO_INCREMENT,
    `date` varchar(45) NOT NULL,
    `temperature` smallint(6) NOT NULL,
    `humidity` tinyint(4) NOT NULL,
    PRIMARY KEY (`key`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;
    ");
    $req = null;
  }

  public function insertNewEntry($date, $temp, $hum) {
    //$this->createDHT11Table();
    $req =$this->db->query("
    CREATE DATABASE  IF NOT EXISTS `DHT11_db`
    USE `DHT11_db`;
    CREATE TABLE `entries` (
    `key` int(11) NOT NULL AUTO_INCREMENT,
    `date` varchar(45) NOT NULL,
    `temperature` smallint(6) NOT NULL,
    `humidity` tinyint(4) NOT NULL,
    PRIMARY KEY (`key`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;
    ");
    $req = null;
    
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
}
