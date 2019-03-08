<?php
namespace DTA\DHT11\View;

use DTA\DHT11\Controller\MeasuresController;

class Page {
    private $view;
    public $allMeasures;
    public $lastMeasures;
    public $rangeStartDate;
    public $rangeEndDate;
    public $avgTemp;
    public $avgHum;
    public $maxTemp;
    public $minTemp;
    public $maxHum;
    public $minHum;
    
    public $reqDelay;
    
    public $previsionIconUrls;
    public $previsionData;
    
    function __construct($view) {
        $this->view = $view;
    }
    
    public function display() {
        require_once ("src/View/".$this->view."View.php");
    }
}