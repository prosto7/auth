<?php

class Router
{
    private $routes;

    public function __construct()
    {
        $routePath = DS . 'config/routes.php';
        $this->routes = include($routePath);
    }

    /*   
  Returns request string
 */
    private function getURI()
    {

        if (!empty($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] != '/') {

            return trim($_SERVER['REQUEST_URI'], '/');
        } else {

            return 'main';    // if url is empty, router will send to 'Conroller_Main'
        }
    }

    public function run()
    {

        $uri = $this->getURI();

        //  Check the request in route.php  ../config/route.php
        foreach ($this->routes as $uriPattern => $path) {

            /* Compare $uriPattern and $uri
                ~ used by as separator instead slashes, because they are in uri 
                 */

            if (preg_match("~$uriPattern~", $uri)) {

                $segments = explode('/', $path);
                $controller_name = array_shift($segments);
                $controller_name = 'Controller_' . (ucfirst($controller_name));
                $action_name = 'action_' . (array_shift($segments));
                $action = $action_name;
                $controller_file = DS . 'application/controllers/' . $controller_name . '.php';

                // if this file located in the directory , create new class, and if this class has method, we call method.

                if (file_exists($controller_file)) {
                    $controller = new $controller_name;

                    if (!method_exists($controller, $action_name)) {
                        exit("Method $action_name not found");
                    } else {
                        $controller->$action();
                    }
                } else {

                    exit("Class $controller_name not found");
                }
            }
        }
    }
}
