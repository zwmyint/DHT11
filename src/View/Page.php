<?php
namespace DTA\DHT11\View;

use DTA\DHT11\Controller\MeasuresController;

class Page {
    private $template;
    private $content;
    
    function __construct($template, $content) {
        $this->template = $template;
        $this->content = $content;
    }
}