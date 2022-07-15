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
        //Vérifier si le fichier routes.yml existe
        if(file_exists($fileRoutes)){
            $this->routes = yaml_parse_file($fileRoutes);
            $this->routesWithParams = $this->getRouteWithParams(); //Permet de récupérer les routes possédant un paramètre
            $this->uri = $slug;

        }else{
            die("Le fichier de routing n'existe pas");
        }
    }

    public function checkRouteExist()
    {

        //Si la route n'existe pas et/ou ne possède pas de controller ou action
        if(empty($this->routes[$this->uri]) || empty($this->routes[$this->uri]["controller"]) || empty($this->routes[$this->uri]["action"])){

            //Vérifier pour chaque route avec un parametre
            foreach ($this->routesWithParams as $key => $value) {
                $routesExist = strstr($this->uri, $key);

                //Si la route existe
                if ($routesExist != false) {
                    $limit = strlen($key);
                    $end_url = substr($this->uri, $limit);
                    $params = explode("/", $end_url);

                    if(!Security::checkRoute($this->routes[$key])){
                        die("NotAuthorized");
                    }

                    $controller = ucfirst(strtolower($this->routes[$key]["controller"]));
                    $action = strtolower($this->routes[$key]["action"]);


                    $adminController = strpos($key, "/admin");
                    if ($adminController === false) {
                        $controllerFile = "Controller/".$controller.".class.php";
                        $controller = "App\\Controller\\".$controller;
                    }
                    else {
                        $controllerFile = "Controller/Admin/".$controller.".class.php";
                        $controller = "App\\Controller\\Admin\\".$controller;
                    }

                    if(!file_exists($controllerFile)){
                        die("Le fichier Controller n'existe pas");
                    }

                    include $controllerFile;


                    if( !class_exists($controller)){
                        die("La classe n'existe pas");
                    }

                    $objectController = new $controller();


                    if(!method_exists($objectController, $action) ){
                        die("La methode n'existe pas");
                    }

                    die(var_dump($params));
                    $objectController->$action($params);
                }
            }
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
                $controller = "App\\Controller\\".$controller;
            }
            else {
                $controllerFile = "Controller/Admin/".$controller.".class.php";
                $controller = "App\\Controller\\Admin\\".$controller;
            }

            if(!file_exists($controllerFile)){
                die("Le fichier Controller n'existe pas");
            }

            include $controllerFile;

//            die(var_dump($controller));

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