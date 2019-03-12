<?php
require_once ('vendor/autoload.php');
use DTA\DHT11\Controller\api\ApiRouter;

header("Content-Type: application/json");

$router = new ApiRouter();

$response = $router->getResponse();


echo $response;
