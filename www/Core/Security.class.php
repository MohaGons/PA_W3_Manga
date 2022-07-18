<?php

namespace App\Core;

use App\Core\Session as Session;

class Security
{

    public static function checkRoute($route):bool
    {
        $security = $route['security'];
        if ($security === 'All'){
        return true;
        }

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
}