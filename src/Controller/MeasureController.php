<?php
namespace DTA\DHT11\Controller;

use DTA\DHT11\Model\MeasureManager;
use DTA\DHT11\View\Page;

require_once('vendor/autoload.php');

class MeasureController {
    
    private $measureManager;
    private $page;
    private $rangeStartDate;
    private $rangeEndDate;
    
    function __construct() {
        $this->measureManager = new MeasureManager();
        $this->page = new Page('thermometer');
    }
    
    public function run() {
        $startReqTs = microtime(true);
        $this->populatePageData();
        $endReqTs = microtime(true);
        $reqDelay = ($endReqTs - $startReqTs) * 1000;
        $this->page->reqDelay = $reqDelay;
        $this->page->display();
    }
    
    public function setRange($startDate, $endDate) {
       $this->rangeStartDate = $startDate;
       $this->rangeEndDate = $endDate;
    }
    
    private function populatePageData() {
        $this->page->lastMeasure = $this->getLastMeasure();
        //$this->page->allMeasures = $this->getAllMeasures();
        $this->page->allMeasures = $this->getMeasuresInRange();
        $this->page->rangeStartDate = $this->rangeStartDate;
        $this->page->rangeEndDate = $this->rangeEndDate;
        $this->page->avgTemp = $this->getAvgTemp();
        //$this->page->avgTemp = $this->getAvgTempPhp();
        $this->page->avgHum = $this->getAvgHum();
        $this->page->maxTemp = $this->getMaxTemp();
        $this->page->minTemp = $this->getMinTemp();
        $this->page->maxHum = $this->getMaxHum();
        $this->page->minHum = $this->getMinHum();
    }
    
    private function getAvgTemp() {
        $sDate = $this->rangeStartDate;
        $eDate = $this->rangeEndDate;
        $result = $this->measureManager->getAvgTemp($sDate, $eDate);
        return $result;
    }
    //alternative, average calculated with php :
    private function getAvgTempPhp() {
        $sDate = $this->rangeStartDate;
        $eDate = $this->rangeEndDate;
        $measures = $this->measureManager->getMeasuresInRange($this->rangeStartDate, $this->rangeEndDate);
        $sumTemps = 0;
        $countTemps = 0;
        foreach ($measures as $measure) {
            $sumTemps += $measure->getTemperature();
            $countTemps++;
        }
        $avgTemp = $sumTemps / $countTemps;
        return $avgTemp;
    }
    
    private function getAvgHum() {
        $sDate = $this->rangeStartDate;
        $eDate = $this->rangeEndDate;
        $result = $this->measureManager->getAvgHum($sDate, $eDate);
        return $result;
    }
    
    private function getMaxTemp() {
        $sDate = $this->rangeStartDate;
        $eDate = $this->rangeEndDate;
        $result = $this->measureManager->getMaxTemp($sDate, $eDate);
        return $result;
    }
    
    private function getMinTemp() {
        $sDate = $this->rangeStartDate;
        $eDate = $this->rangeEndDate;
        $result = $this->measureManager->getMinTemp($sDate, $eDate);
        return $result;
    }
    
    private function getMaxHum() {
        $sDate = $this->rangeStartDate;
        $eDate = $this->rangeEndDate;
        $result = $this->measureManager->getMaxHum($sDate, $eDate);
        return $result;
    }
    
    private function getMinHum() {
        $sDate = $this->rangeStartDate;
        $eDate = $this->rangeEndDate;
        $result = $this->measureManager->getMinHum($sDate, $eDate);
        return $result;
    }
        
    private function getLastMeasure() {
        $result = $this->measureManager->getLastMeasure();
        return $result;
    }
    
    private function getAllMeasures() {
        $entries = $this->measureManager->getAllMeasures();
        return $entries;
    }
    private function getMeasuresInRange() {
        $entries = $this->measureManager->getMeasuresInRange($this->rangeStartDate, $this->rangeEndDate);
        return $entries;
    }
    
    
}