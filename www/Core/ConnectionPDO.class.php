<?php

namespace App\Core;

use PDO;

class ConnectionPDO {
    private static $instance = null;
    public $pdo;

    // Simulate Environnement Variables
    private $database = DB_DRIVER.':port='.DB_PORT.';:dbname='.DB_NAME.';host='.DB_HOST;
    private $username = DB_USER;
    private $password = DB_PASSWORD;

    public function __construct()
    {
        try {
            $this->pdo = new PDO( DB_DRIVER.":host=".DB_HOST.";port=".DB_PORT.";dbname=".DB_NAME , DB_USER , DB_PASSWORD
                , [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING]);
        }
        catch(\Exception $e){
            die("Erreur SQL : ".$e->getMessage());
        }
    }

    public static function  getInstance() {

        if ( is_null(self::$instance ) ) {

            self::$instance = new ConnectionPDO();

        }

        return self::$instance;

    }

}
