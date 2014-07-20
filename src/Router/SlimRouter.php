<?php
namespace Centralino\Router;

class SlimRouter extends RouterAbstract
{
    private $slim;

    public function __construct()
    {
        $this->slim = new \Slim\Slim();
    }

    public function registerRoute($route)
    {
        $routeName = $route['route'];
        $service = $route['service'];
        $serviceMethod = $route['method'];
        $httpMethods = $route['httpmethods'];

        if(! class_exists($service)) {
            throw new \Exception('Service not found');
        }

        $serviceClass = new $service;

        if(! method_exists($serviceClass, $serviceMethod)) {
            throw new \Exception('Service method not found');
        }

        $serviceMethodCallback = function ($params) use ($serviceClass, $serviceMethod) {
            $serviceClass->$serviceMethod($params);
        };

        $this->slim->map($routeName, function () use ($serviceMethodCallback) {
            $routeParameters = $this->slim->router()->getCurrentRoute()->getParams();
            $serviceMethodCallback($routeParameters);
        })->via(array_walk($httpMethods, function ($value) {
            return $value;
        }));
        
        $serviceClass->setUp();
    }

    public function initialize()
    {
        $this->slim->run();
    }
}
