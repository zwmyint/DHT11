<?php
class DHT11_DbManager {
  private $host;
  private $username;
  private $password;
  public $db;

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
}
