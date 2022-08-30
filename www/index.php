<?php
/*
namespace App;

//die(__DIR__."/Style");
require "conf.css.php";

use App\Core\Router;
use App\Core\Install;

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
    $admin = Install::start();
    if (!empty($admin)){
        require "conf.inc.php.php";
        Install::createUserAdmin($admin["WEBSITE_ADMIN"], $admin["WEBSITE_PASSWORD"]);
        return header("Location: /login");
    }
    return;
}
else {
    require "conf.inc.php.php";
}

//Vérifier si la route appelé existe
$routes = new Router($_SERVER["REQUEST_URI"]);
$tab = $routes->checkRouteExist();
*/

namespace App;

//die(__DIR__."/Style");
require "conf.css.php";

use App\Core\Install;
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

if (!Install::check()) {
    $admin = Install::start();
    if (!empty($admin)){
        require "conf.inc.php";
        Install::createDatabaseAndTable($admin);
        Install::createUserAdmin($admin["WEBSITE_ADMIN"], $admin["WEBSITE_PASSWORD"]);
        return header("Location: /login");
    }
    return;
}
else {
    require "conf.inc.php";
}

//Vérifier si la route appelé existe
$routes = new Router($_SERVER["REQUEST_URI"]);
$tab = $routes->checkRouteExist();






