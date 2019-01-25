<?php
class Measure {
  private temperature;
  private humidity;
  private date;

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
