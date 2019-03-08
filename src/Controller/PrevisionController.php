<?php
namespace DTA\DHT11\Controller;

use DTA\DHT11\Model\PrevisionManager;

require_once('vendor/autoload.php');

class PrevisionController {
    
    private $previsionManager;
    private $locality;
     
    function __construct($locality) {
        $this->locality = $locality;
        $this->previsionManager = new PrevisionManager($this->locality);
    }
    
    public function getPrevisionData() {
        return $this->previsionManager->getPrevisionData();
    }
    
    public function setLocality($locality) {
        //$this->previsionManager->setLocalityData($locality);
    }
    
}