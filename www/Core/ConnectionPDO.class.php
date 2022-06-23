<?php

namespace App\Core;

use PDO;

class ConnectionPDO {
    private static $instance = null;
    public $pdo;

    // Simulate Environnement Variables
    private $database = DBDRIVER.':port='.DBPORT.';:dbname='.DBNAME.';host='.DBHOST;
    private $username = DBUSER;
    private $password = DBPWD;


    public function __construct()
    {
        try {
            $this->pdo = new PDO( DBDRIVER.":host=".DBHOST.";port=".DBPORT.";dbname=".DBNAME , DBUSER , DBPWD
                , [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING]);
        }
        catch(\Exception $e){
            die("Erreur SQL : ".$e->getMessage());
        }
    }

    public static function getInstance() {

        if ( is_null(self::$instance ) ) {

            self::$instance = new ConnectionPDO();

        }

        return self::$instance;

    }

}