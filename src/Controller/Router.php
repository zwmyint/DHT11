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
        if (isset($_GET["c"])) {
            $controllerName = htmlspecialchars($_GET['c']);
            if ($controllerName == "measure") $this->controller = new MeasureController();
            else if ($controllerName == "store") $this->controller = new StoreController();
            else $this->controller = new MeasureController();

        } else {
            $this->controller = new MeasureController();
        }
        
        $this->controller->run();
    }
}

