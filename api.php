<?php
require_once ('vendor/autoload.php');
use DTA\DHT11\Controller\api\ApiRouter;

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$router = new ApiRouter();

$response = $router->getResponse();


echo $response;
