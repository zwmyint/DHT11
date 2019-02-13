<?php
namespace DTA\DHT11\Controller;

use DTA\DHT11\Model\MeasureManager;
use DTA\DHT11\View\Page;

require_once('vendor/autoload.php');

class MeasureController {
    
    private $measureManager;
    private $page;
    
    function __construct() {
        $this->measureManager = new MeasureManager();
        $this->page = new Page('thermometer');
    }
    
    public function run() {
        $this->populatePageData();
        $this->page->display();
    }
        
    private function getLastMeasure() {
        $result = $this->measureManager->getLastMeasure();
        return $result;
    }
    
    private function getAllMeasures() {
        $entries = $this->measureManager->getAllMeasures();
        return $entries;
    }
    
    private function populatePageData() {
        $this->page->lastMeasure = $this->getLastMeasure();
        $this->page->allMeasures = $this->getAllMeasures();
    }
}