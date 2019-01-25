<?php
require_once('Model/MeasureManager.php');

function readData() {
  require_once('Model/pdoConfig.php');
  $measureManager = new MeasureManager($host, $username, $password);
  $result = $measureManager->getLastEntry();
  return $result;
}
