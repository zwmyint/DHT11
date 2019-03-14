<?php
namespace DTA\DHT11\Controller;

use DTA\DHT11\Model\MeasureManager;
use DTA\DHT11\View\Page;
use DTA\DHT11\Controller\PrevisionController;
use DTA\DHT11\Controller\MeasureController;

require_once('vendor/autoload.php');

class DashboardController {

    private $previsionController;
    private $measureController;
    private $page;
    private $rangeStartDate;
    private $rangeEndDate;
    private $locality;

    function __construct($locality) {

        $this->locality = $locality;

        $this->previsionController = new PrevisionController($this->locality);

        $this->measureController = new MeasureController();

        $this->page = new Page('dashboard');
    }

    public function run() {
        $startReqTs = microtime(true);//performance measure, opt.
        $this->populatePageData();
        $endReqTs = microtime(true);//perf
        $reqDelay = ($endReqTs - $startReqTs) * 1000;//perf
        $this->page->reqDelay = $reqDelay;
        $this->page->display();
    }

    public function setMeasuresRange($startDate, $endDate) {
       $this->measureController->setRange($startDate, $endDate);
    }

    private function populatePageData() {
        $this->page->lastMeasure = $this->measureController->getLastMeasure();
        //$this->page->allMeasures = $this->getAllMeasures();
        $this->page->allMeasures = $this->measureController->getMeasuresInRange();
        $this->page->rangeStartDate = $this->measureController->rangeStartDate;
        $this->page->rangeEndDate = $this->measureController->rangeEndDate;
        $this->page->avgTemp = $this->measureController->getAvgTemp();
        //$this->page->avgTemp = $this->getAvgTempPhp();
        $this->page->avgHum = $this->measureController->getAvgHum();
        $this->page->maxTemp = $this->measureController->getMaxTemp();
        $this->page->minTemp = $this->measureController->getMinTemp();
        $this->page->maxHum = $this->measureController->getMaxHum();
        $this->page->minHum = $this->measureController->getMinHum();
        $this->page->previsionData = $this->previsionController->getPrevisionData();
    }

}
