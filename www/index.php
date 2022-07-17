<?php
namespace App;

//die(__DIR__."/Style");
require "conf.inc.php";

use App\Core\Security;
use App\Core\Session as Session;
use App\Core\Router;
//E
//Permet de charger les classes appellés
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

//Vérifier si la route appelé existe
$routes = new Router($_SERVER["REQUEST_URI"]);
die("gggggggg");
$tab = $routes->checkRouteExist();

