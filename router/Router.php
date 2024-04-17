<?php

// include "./autoload.php";
include "./controllers/UserController.php";
include "./controllers/AuthController.php";
include "./controllers/ProfilController.php";
include "./controllers/Middleware.php";
include "./controllers/MessengerController.php";
include "./controllers/TweetController.php";
include "./controllers/HomepageController.php";
include "./controllers/FollowController.php";
include "./controllers/HashtagController.php";
include "./controllers/ManageReactController.php";

class Router
{
    private $routes = [];

    public function addRoute($method, $route, $controller)
    {
        $this->routes[$method][$route] = $controller;
    }

    public function handleRequest($method, $uri)
    {
        if (array_key_exists($method, $this->routes) && array_key_exists($uri, $this->routes[$method])) {

            $controllerInfo = $this->routes[$method][$uri];
            $parts = explode('@', $controllerInfo);
            $controllerName = $parts[0];
            $methodName = $parts[1];

            $controller = new $controllerName();
            $controller->$methodName();
        } else {

            header("Location: 404");
        }
    }
}
