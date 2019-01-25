<?php
require_once('Model/MeasureManager.php');
require_once('Model/pdoConfig.php');

function readLastEntry() {
  global $host;
  global $username;
  global $password;
  $measureManager = new MeasureManager($host, $username, $password);
  $result = $measureManager->getLastEntry();
  return $result;
}

function readAllEntries() {
  global $host;
  global $username;
  global $password;
  $measureManager = new MeasureManager($host, $username, $password);
  $entries = $measureManager->getAllMeasures();
  return $entries;
}
