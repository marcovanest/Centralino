<?php
namespace Centralino\Router\Route;

class Registry
{
    private $routes;

    public function __construct()
    {
        $this->routes = new \Centralino\Utility\CentralinoArray(array());
    }

    public function addRoute($route, $routeClass)
    {
        if (! isset($this->routes[$route])) {
            $this->routes[$route] = $routeClass;
        }

        return true;
    }

    public function getRoute($route)
    {
        if (isset($this->routes[$route])) {
            return $this->routes[$route];
        }

        return false;
    }

    public function getRegisteredRoutes()
    {
        return $this->routes;
    }
}
