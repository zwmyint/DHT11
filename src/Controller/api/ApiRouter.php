<?php
namespace DTA\DHT11\Controller\api;

require_once ('vendor/autoload.php');

/*use DTA\DHT11\Controller\DashboardController;
use DTA\DHT11\Controller\StoreController;*/
use DTA\DHT11\Controller\api\MeasureController;

//routes for http://ipaddress/index.php
class ApiRouter {

    private $controller;
    private $response;
    private $request;

    function __construct() {
        $this->setController();
    }

    private function setController() {

        $this->controller = new MeasureController();//default;
        $this->request = "all";//default

        if(isset($_GET["c"])) {
            if($_GET["c"] === "measures") {
                $this->controller = new MeasureController();
            }
        }

        if (isset($_GET["req"])) {
            $this->request = htmlspecialchars($_GET["req"]);
        }

        if (isset($_GET["rstart"]) && isset($_GET["rend"])) {
          if ($this->controller instanceof MeasureController ) {
            $this->controller->setRange($_GET["rstart"], $_GET["rend"]);
          }
        }

        $this->response = $this->controller->run($this->request);
    }

    public function getResponse() {
        return $this->response;
    }
}
