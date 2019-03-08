<?php
/*$host = 'localhost';
//$dbname = 'DHT11_db';
$username = 'root';
//$password = '52dLmenJspp@y!?ueiHHt';//password vps
$password = 'Peterclash@072642';//password localhost Pierre
$dataFile = '/Model/data.txt';*/
namespace DTA\DHT11\inc;

class PdoConfig {
    private const DATA = array(
        'host'=>'localhost',
        'username'=>'root',
        'password'=>'52dLmenJspp@y!?ueiHHt',
        'dataFile'=>'/Model/data.txt'
    );
    public static function getData() {
        return self::DATA;
    }
}