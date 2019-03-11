<?php
namespace DTA\DHT11\Controller;

require_once ('vendor/autoload.php');

use DTA\DHT11\Controller\DashboardController;
use DTA\DHT11\Controller\StoreController;

//routes for http://ipaddress/index.php
class Router {
    
    private $controller;
    
    function __construct() {
        $this->setController();
    }
    
    private function setController() {
        
        $dateRangeStart = date('Y-m-d', strtotime("-1 month"));//default
        $dateRangeEnd = date('Y-m-d');
        $locality = "saint-etienne-42";
        
        if (isset($_GET["c"])) {
            $controllerName = htmlspecialchars($_GET['c']);
            if ($controllerName == "dashboard") {

                if(isset($_GET["range_start"]) && isset($_GET["range_end"])) {
                    
                    $dateRangeStart = $_GET["range_start"];
                    $dateRangeEnd = $_GET["range_end"];
                    
                }
                
                if (isset($_GET["locality"])) {
                    
                    $locality = htmlspecialchars($_GET["locality"]);
                    
                }
                
                $this->controller = new DashboardController($locality);
                $this->controller->setMeasuresRange($dateRangeStart, $dateRangeEnd);
                
            } else if ($controllerName == "store") {
                
                $this->controller = new StoreController();
                
            } else {//default controller if c parameter is unknown
                
                $this->controller = new DashboardController($locality);
                $this->controller->setMeasuresRange($dateRangeStart, $dateRangeEnd);
                
            }

        } else {//default controller if c parameter is not set
            $this->controller = new DashboardController($locality);
            $this->controller->setMeasuresRange($dateRangeStart, $dateRangeEnd);
            
        }
        
        $this->controller->run();
    }
}

