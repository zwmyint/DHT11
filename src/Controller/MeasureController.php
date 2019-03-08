<?php
namespace DTA\DHT11\Controller;

use DTA\DHT11\Model\MeasureManager;
use DTA\DHT11\View\Page;
use DTA\DHT11\Controller\PrevisionController;

require_once('vendor/autoload.php');

class MeasureController {
    
    private $measureManager;
    public $rangeStartDate;
    public $rangeEndDate;
    
    function __construct() {
        $this->measureManager = new MeasureManager();
    }
    
    public function setRange($startDate, $endDate) {
       $this->rangeStartDate = $startDate;
       $this->rangeEndDate = $endDate;
    }
    
    public function getAvgTemp() {
        $sDate = $this->rangeStartDate;
        $eDate = $this->rangeEndDate;
        $result = $this->measureManager->getAvgTemp($sDate, $eDate);
        return $result;
    }
    //alternative, average calculated with php :
    public function getAvgTempPhp() {
        $sDate = $this->rangeStartDate;
        $eDate = $this->rangeEndDate;
        $measures = $this->measureManager->getMeasuresInRange($this->rangeStartDate, $this->rangeEndDate);
        $sumTemps = 0;
        $countTemps = 0;
        foreach ($measures as $measure) {
            $sumTemps += $measure->getTemperature();
            $countTemps++;
        }
        if (!$countTemps == 0) {
            $avgTemp = $sumTemps / $countTemps;
            return $avgTemp;
        }
        return 0;
    }
    
    public function getAvgHum() {
        $sDate = $this->rangeStartDate;
        $eDate = $this->rangeEndDate;
        $result = $this->measureManager->getAvgHum($sDate, $eDate);
        return $result;
    }
    
    public function getMaxTemp() {
        $sDate = $this->rangeStartDate;
        $eDate = $this->rangeEndDate;
        $result = $this->measureManager->getMaxTemp($sDate, $eDate);
        return $result;
    }
    
    public function getMinTemp() {
        $sDate = $this->rangeStartDate;
        $eDate = $this->rangeEndDate;
        $result = $this->measureManager->getMinTemp($sDate, $eDate);
        return $result;
    }
    
    public function getMaxHum() {
        $sDate = $this->rangeStartDate;
        $eDate = $this->rangeEndDate;
        $result = $this->measureManager->getMaxHum($sDate, $eDate);
        return $result;
    }
    
    public function getMinHum() {
        $sDate = $this->rangeStartDate;
        $eDate = $this->rangeEndDate;
        $result = $this->measureManager->getMinHum($sDate, $eDate);
        return $result;
    }
        
    public function getLastMeasure() {
        $result = $this->measureManager->getLastMeasure();
        return $result;
    }
    
    public function getAllMeasures() {
        $entries = $this->measureManager->getAllMeasures();
        return $entries;
    }
    public function getMeasuresInRange() {
        $entries = $this->measureManager->getMeasuresInRange($this->rangeStartDate, $this->rangeEndDate);
        return $entries;
    } 
    
}