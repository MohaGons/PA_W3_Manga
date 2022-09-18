<?php

namespace App\Core;

use App\Core\Session as Session;
use App\Core\View as View;

class Security
{

    public static function checkRoute($route):bool
    {
        if (empty($route['security'])){
            return true;
        }

        $security = $route['security'];

        if(!empty(Session::get("role"))){
            $role = Session::get("role");
            if (in_array($role, $security))
            {
                return true;
            }
            return false;
        }
        else{
            return false;
        }
    }

    public static function returnHttpResponseCode($code) {
        http_response_code($code);
        $view = new View("error/".$code, "error");
        die();
    }
}