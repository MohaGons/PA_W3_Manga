<?php

namespace App\Core;


class Router
{
    private $routes = [];
    private $routesWithParams = [];
    private $uri = "";

    public function __construct($slug)
    {
        $fileRoutes = "routes.yml";

        if(file_exists($fileRoutes)){
            $this->routes = yaml_parse_file($fileRoutes);
            $this->routesWithParams = $this->getRouteWithParams();
            $this->uri = $slug;
//            echo "<pre>";
//            die(var_dump($this->routesWithParams));
//            $this->slug = strpos($slug, "/");
//
//            var_dump($this->slug);
//            if (substr($slug, -1) == '/') {
//                var_dump("yes");
//                $slug = rtrim($slug, '/');
//            }
//
//            $this->slug = $slug ?: '/';
        }else{
            die("Le fichier de routing n'existe pas");
        }
    }

    public function checkRouteExist()
    {
        if(empty($this->routes[$this->uri]) || empty($this->routes[$this->uri]["controller"]) || empty($this->routes[$this->uri]["action"])){
            echo "<pre>";
            var_dump($this->uri);
            var_dump(strstr($this->uri, "/admin/utilisateurs/update/"));
            var_dump(strlen("/admin/utilisateurs/update/"));
            $limit = strlen("/admin/utilisateurs/update/");
            var_dump(substr($this->uri, $limit));
            $other_url = substr($this->uri, $limit);
            $params = explode("/", $other_url);
            var_dump($params);
            die();
            die("Page 404");
        }
        else {

            if(!Security::checkRoute($this->routes[$this->uri])){
                die("NotAuthorized");
            }

            $controller = ucfirst(strtolower($this->routes[$this->uri]["controller"]));
            $action = strtolower($this->routes[$this->uri]["action"]);


            $adminController = strpos($this->uri, "/admin");
            if ($adminController === false) {
                $controllerFile = "Controller/".$controller.".class.php";
            }
            else {
                $controllerFile = "Controller/Admin/".$controller.".class.php";
            }

            if(!file_exists($controllerFile)){
                die("Le fichier Controller n'existe pas");
            }

            include $controllerFile;

            $controller = "App\\Controller\\".$controller;
            if( !class_exists($controller)){
                die("La classe n'existe pas");
            }

            $objectController = new $controller();


            if(!method_exists($objectController, $action) ){
                die("La methode n'existe pas");
            }

            $objectController->$action();
        }

    }

    public function getRouteWithParams()
    {
        foreach ($this->routes as $key => $value) {
            if ($value["params"] != null)
            {
                $this->routesWithParams[$key] = $value;
            }

        }

        return $this->routesWithParams;

    }

}