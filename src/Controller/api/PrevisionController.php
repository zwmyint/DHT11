<?php
namespace DTA\DHT11\Controller\api;

use DTA\DHT11\Model\PrevisionManager;

require_once('vendor/autoload.php');

class PrevisionController {

    private $previsionManager;
    private $locality;

    function __construct($locality) {
        $this->locality = $locality;
        $this->previsionManager = new PrevisionManager($this->locality);
    }

    public function run() {
      return json_encode($this->getPrevisionData());
    }

    public function getPrevisionData() {
        return $this->previsionManager->getPrevisionData();
    }

}
