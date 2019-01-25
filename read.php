<?php
require_once('DHT11_DbManager.php');

function readData() {
  require_once('pdoConfig.php');
  $dbManager = new DHT11_DbManager($host, $username, $password);
  $result = $dbManager->getLastEntry();
  return $result;
}
