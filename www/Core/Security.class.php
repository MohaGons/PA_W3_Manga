<?php

namespace App\Core;

use PDO;
use function App\myAutoloader;

class Security extends Sql
{

    public static function checkRoute($route):bool
    {
        /*
         * /dashboard:
              Controller: admin
              action: home
              security: true
         *
         */
        return true;
    }




}