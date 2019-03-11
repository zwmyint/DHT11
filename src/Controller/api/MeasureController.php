<?php
namespace DTA\DHT11\Controller\api;

use DTA\DHT11\Model\ApiMeasureManager as MeasureManager;

require_once('vendor/autoload.php');

class MeasureController {
    
    private $measureManager;
    public $rangeStartDate;
    public $rangeEndDate;
    private $apiIndexedGetMethods;
    
    function __construct() {
        $this->measureManager = new MeasureManager();
        
        $this->apiIndexedGetMethods = array(
            "all" => "getAllMeasures",
        );
    }
    
    public function run($key) {
        if(array_key_exists($key, $this->apiIndexedGetMethods)) {
            return $this->{$this->apiIndexedGetMethods[$key]}();
        }
        else return "ERROR : method doesn't exist";
    }
    
    public function getAllMeasures() {
        
        return $this->measureManager->getAllMeasures();
        
    }
    
}