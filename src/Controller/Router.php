<?php
namespace DTA\DHT11\Controller;

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
                throw new Exception("NoController");
            }
            catch (Exception $e){
                $this->controller = new DTA\DHT11\Controller\MeasureController();
            }
        }
    }
}

