<?php
namespace DTA\DHT11\View;

use DTA\DHT11\Controller\MeasuresController;

class Page {
    private $view;
    
    function __construct($view) {
        $this->view = $view;
    }
    
    public function display() {
        require_once ("src/View/".$this->view."View.php");
    }
}