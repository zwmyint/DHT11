<?php
namespace DTA\DHT11\Model;

require_once('inc/PdoConfig.php');

use DTA\DHT11\inc\PdoConfig as PdoConfig;

class DHT11_DbManager {
    private $config;
    public $db;
    
    function __construct() {
        
        $this->config = PdoConfig::getData();
        $this->connect();
    }
    
    private function connect() {
        try {
            $this->db = new PDO("mysql:host=$this->config->host;charset=utf8", $this->config->username, $this->config->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return "Connecté à ".$this->config->host." avec succès.";
        }
        catch (PDOException $e) {
            die("Error while connecting to database : ".$e->getMessage());
        }
    }
}


