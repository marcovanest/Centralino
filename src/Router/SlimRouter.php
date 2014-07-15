<?php
namespace Centralino\Router;

class SlimRouter extends RouterAbstract
{
    private $slim;

    public function __construct()
    {
        $this->slim = new \Slim\Slim();
    }

    public function registerRouteFromService($implementation, $serviceCallback)
    {
        $route = $implementation['route'];
        $httpMethods = $implementation['httpmethods'];

        if (! is_callable($serviceCallback)) {
            throw new \Exception('Service method not callable');
        }

        $this->slim->map($route, function () use ($serviceCallback) {
            $routeParameters = $this->slim->router()->getCurrentRoute()->getParams();
            $serviceCallback($routeParameters);
        })->via(array_walk($httpMethods, function ($value) {
            return $value;
        }));
    }

    public function initialize()
    {
        $this->slim->run();
    }
}
