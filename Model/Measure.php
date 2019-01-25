<?php
class Measure {
  private $temperature;
  private $humidity;
  private $date;

  function __construct($date, $temp, $hum) {
    $this->temperature = $temp;
    $this->humidity = $hum;
    $this->date = $date;
  }
  public function getTemperature() {
    return $this->temperature;
  }
  public function getHumidity() {
    return $this->humidity;
  }
  public function getDate() {
    return $this->date;
  }
  public function getMeasureData() {
    $data = array(
      'temperature'=>$this->temperature,
      'humidity'=>$this->humidity,
      'date'=>$this->date
    );
    return $data;
  }
}
