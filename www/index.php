<?php
namespace App;

//die(__DIR__."/Style");
require "conf.inc.php";
use App\Core\Security;
use App\Core\Router;
//E

function myAutoloader( $class )
{
    // $class -> "Core\Security" "Model\User
    $class = str_ireplace("App\\","",$class);

    // $class -> "Core/Security" "Model/User
    $class = str_replace("\\","/",$class);


    // $class -> "Core/Security"
    if(file_exists($class.".class.php")){
        include $class.".class.php";
    }
}

spl_autoload_register("App\myAutoloader");
$routes = new Router($_SERVER["REQUEST_URI"]);
$tab = $routes->checkRouteExist();




