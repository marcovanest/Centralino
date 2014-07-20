<?php
namespace Centralino\Router;

abstract class RouterAbstract implements RouterInterface
{
    public function registerRoutes(\Centralino\Router\Route\Registry $routeRegistry)
    {
        $routes = $routeRegistry->getRegisteredRoutes();

        foreach ($routes as $route => $routeClassName) {

            if (! $this->isClassDefined($routeClassName)) {
                throw new \Exception('Invalid route given');
            }

            $routeClass = new $routeClassName();

            foreach ($routeClass->routes() as $route) {
               $this->registerRoute($route);
            }
        }
    }

    public function isClassDefined($routeClassName)
    {
        return class_exists($routeClassName);
    }

    public function isClassMethodDefined($route, $method)
    {
        return method_exists($route, $method);
    }
}
