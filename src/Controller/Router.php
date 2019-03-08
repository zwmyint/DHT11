<?php
namespace DTA\DHT11\Controller;

require_once ('vendor/autoload.php');
//require_once ('MeasureController.php');

use DTA\DHT11\Controller\MeasureController;
use DTA\DHT11\Controller\StoreController;


class Router {
    
    private $controller;
    
    function __construct() {
        $this->setController();
    }
    
    private function setController() {
        
        $dateRangeStart = date('Y-m-d', strtotime("-1 month"));
        $dateRangeEnd = date('Y-m-d');
        
        if (isset($_GET["c"])) {
            $controllerName = htmlspecialchars($_GET['c']);
            if ($controllerName == "measure") {

                if(isset($_GET["range_start"]) && isset($_GET["range_end"])) {
                    
                    $dateRangeStart = $_GET["range_start"];
                    $dateRangeEnd = $_GET["range_end"];
                    
                }
                
                $this->controller = new MeasureController();
                $this->controller->setRange($dateRangeStart, $dateRangeEnd);
                
            } else if ($controllerName == "store") {
                
                $this->controller = new StoreController();
                
            } else {
                
                $this->controller = new MeasureController();
                $this->controller->setRange($dateRangeStart, $dateRangeEnd);
                
            }

        } else {
            $this->controller = new MeasureController();
            $this->controller->setRange($dateRangeStart, $dateRangeEnd);
            
        }
        
        $this->controller->run();
    }
}

