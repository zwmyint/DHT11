<?php
namespace DTA\DHT11\Controller;

use DTA\DHT11\Model\MeasureManager;
use DTA\DHT11\Model\Measure;

require_once('vendor/autoload.php');

class StoreController {
    private $measureManager;
    private $jsonData;
    
    function __construct() {
        $this->measureManager = new MeasureManager();
        $this->createJson();
    }
    
    private function createJson() {
        
        $new_json = file_get_contents("php://input");
        
        $data = json_decode($new_json);
        
        if (!$data) {
            http_response_code(415);
            exit();
        } elseif (!$data->temperature || !$data->humidity) {
            http_response_code(400);
            exit();
        }
        if (!$new_json) {
            http_response_code(500);
            exit();
        }
        $this->jsonData = $data;
    }
    
    private function writeData() {
        $dataFile = 'src/Model/data.txt';
        
        file_put_contents($dataFile, $this->jsonData);;
        $temp = $this->jsonData->temperature;
        $hum = $this->jsonData->humidity;
        $date = date('\l\e Y-m-d \à H:i:s');
        
        $measure = new Measure($date, $temp, $hum);
        $measureManager = new MeasureManager();
        $measureManager->insertNewMeasure($measure);
    }
    
    public function run() {
        $this->writeData();
    }
}

