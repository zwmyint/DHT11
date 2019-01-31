<?php
namespace DTA\DHT11\Controller;

use DTA\DHT11\Model\MeasureManager;

require_once('vendor/autoload.php');

/*require_once('Model/MeasureManager.php');*/

class MeasureController {
    
    private $measureManager;
    private $page;
    
    function __construct() {
        
        $this->measureManager = new MeasureManager();
        $this->page = new Page("","");
    }
        
    public function getLastEntry() {
        $result = $this->measureManager->getLastMeasure();
        return $result;
    }
    
    public function getAllEntry() {
        $entries = $this->measureManager->getAllMeasures();
        return $entries;
    }
}