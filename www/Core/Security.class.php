<?php

namespace App\Core;

class Security
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

        $role = "admn";

        if (in_array($role, $route["role"])) {
            return true;
        }
        else {
            return false;

        }
    }


}