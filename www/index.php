<?php
namespace App;

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
echo "<pre>";
die(var_dump($tab));

$fileRoutes = "routes.yml";

if(file_exists($fileRoutes)){
    $routes = yaml_parse_file($fileRoutes);
}else{
    die("Le fichier de routing n'existe pas");
}

$uri = explode("?", $_SERVER["REQUEST_URI"])[0];

if(empty($routes[$uri]) || empty($routes[$uri]["controller"]) || empty($routes[$uri]["action"])){
    die("Page 404");
}



