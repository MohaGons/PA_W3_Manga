<?php

namespace App\Core;
use App\Model\User as UserModel;
use PDO;
use function App\myAutoloader;
use App\Core\Session as Session;
class Security extends Sql
{

    public static function checkRoute($route):bool
    {
        $session =new Session();
        $session->ensureStarted();
        $security = $route['security'];
        if ($security==='All'){
        return true;
        }
        if(isset($_SESSION['role'])){
            $role = $_SESSION['role'];
            for ($i=0;$i<count($security);$i++){
                if ($security[$i]===$role){
                    return true;
                }
            }
            return false;
        }
        else{
            return false;
        }

    }

}
