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
        Session::get("role");
        if(!empty($_SESSION['role'])){
            $role = $_SESSION['role'];
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