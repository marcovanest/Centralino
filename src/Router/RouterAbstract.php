<?php
namespace Centralino\Router;

abstract class RouterAbstract implements RouterInterface
{
    public function registerRoutes(\Centralino\Router\Route\Registry $routeRegistry)
    {
        $routes = $routeRegistry->getRegisteredRoutes();

        foreach ($routes as $route => $routeClass) {

            if (! class_exists($routeClass)) {
                throw new \Exception('Invalid route given');
            }

            $routeClass = new $routeClass();

            foreach ($routeClass->routes() as $route) {
               $this->registerRoute($route);
            }
        }
    }
}
