<?php
class DbManager {
  private $host;
  private $dbname;
  private $username;
  private $password;
  private $db;

  function __construct($host, $dbname, $username, $password) {
    $this->host = $host;
    $this->dbname = $dbname;
    $this->username = $username;
    $this->password = $password;
  }

  public funtion connect() {
    try {
      $this->db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
      return "Connecté à ".$dbname." @ ".$host." avec succès.";
    }
    catch (PDOException $e) {
      die("Error while connecting to database : ".$e->getMessage());
    }
  }
  public function insertNewEntry($date, $temp, $hum) {
    $req = $this->db->prepare('
      INSERT INTO entries (date, temperature, humidity)
      VALUES (:date, :temperature, :humidity);
    ');
    try {
      $req->execute(array(
        ':date'=>$date,
        ':temperature'=>$temp,
        ':hum'=>$hum
      ));
    }
    catch (PDOException $e) {
      die("Erreur: ".$e->getMessage());
    }
  }
}
