<?php
namespace DTA\DHT11\Model;

require_once('vendor/autoload.php');

class PrevisionManager {

    private $previsionData;
    private $locality;

    function __construct($locality) {
        $this->locality = $locality;
        $this->reqPrevision();
    }

    private function reqPrevision() {

        $r = file_get_contents('https://www.prevision-meteo.ch/services/json/'.$this->locality);
        $result = json_decode($r);

        $this->previsionData = array(
            'locality' => $result->city_info->name,
            'current_condition' => $result->current_condition->condition,
            'days' => array (
                'dp0' => array(
                    'icon' => $result->fcst_day_0->icon,
                    'condition' => $result->fcst_day_0->condition,
                    'tempMax' => $result->fcst_day_0->tmax,
                    'tempMin' => $result->fcst_day_0->tmin,
                    'date' => $result->fcst_day_0->date
                ),
                'dp1' => array(
                    'icon' => $result->fcst_day_1->icon,
                    'condition' => $result->fcst_day_1->condition,
                    'tempMax' => $result->fcst_day_1->tmax,
                    'tempMin' => $result->fcst_day_1->tmin,
                    'date' => $result->fcst_day_1->date
                ),
                'dp2' => array(
                    'icon' => $result->fcst_day_2->icon,
                    'condition' => $result->fcst_day_2->condition,
                    'tempMax' => $result->fcst_day_2->tmax,
                    'tempMin' => $result->fcst_day_2->tmin,
                    'date' => $result->fcst_day_2->date
                ),
                'dp3' => array(
                    'icon' => $result->fcst_day_3->icon,
                    'condition' => $result->fcst_day_3->condition,
                    'tempMax' => $result->fcst_day_3->tmax,
                    'tempMin' => $result->fcst_day_3->tmin,
                    'date' => $result->fcst_day_3->date
                ),
                'dp4' => array(
                    'icon' => $result->fcst_day_4->icon,
                    'condition' => $result->fcst_day_4->condition,
                    'tempMax' => $result->fcst_day_4->tmax,
                    'tempMin' => $result->fcst_day_4->tmin,
                    'date' => $result->fcst_day_4->date
                ),
            )
        );

    }

    public function getPrevisionData() {
        return $this->previsionData;
    }

}
