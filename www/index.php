<?php
namespace App;

//die(__DIR__."/Style");
require "conf.css.php";

use App\Core\Security;
use App\Core\Session as Session;
use App\Core\Router;
use App\Core\Install;
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


if (!Install::check()) {
    $start = Install::start();
    if ($start == true){
        require "conf.inc.php";
        return;
    }
    return;
}
else {
    require "conf.inc.php";
}

//Vérifier si la route appelé existe
$routes = new Router($_SERVER["REQUEST_URI"]);
$tab = $routes->checkRouteExist();








