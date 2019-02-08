<?php
namespace DTA\DHT11\Controller;

require_once ('vendor/autoload.php');
//require_once ('MeasureController.php');

use DTA\DHT11\Controller\MeasureController as MeasureController;

class Router {
    private $controller;
    
    function __construct() {
        $this->setController();
    }
    
    private function setController() {
        if (isset($_GET["c"])) {
            $controllerName = 'DTA\\DHT11\\Controller\\' .htmlspecialchars($_GET['c']) .'Controller';
            try {
                $this->controller = new $controllerName();
                
                throw new \Exception("NoController");
            }
            catch (\Exception $e){
                $this->controller = new MeasureController();
                
            }
        } else {
            $this->controller = new MeasureController();
            
        }
        
        $this->controller->run();
    }
}

