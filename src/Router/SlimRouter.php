<?php
namespace Centralino\Router;

class SlimRouter extends RouterAbstract
{
    private $slim;

    public function __construct(\Slim\Slim $slim)
    {
        $this->slim = $slim;
    }

    public function registerRoute($route)
    {
        $routeName = $route['route'];
        $serviceClassName = $route['service'];
        $serviceMethod = $route['method'];
        $httpMethods = $route['httpmethods'];

        $service = $this->getServiceInstance($serviceClassName);

        $method = $this->getServiceMethodCallBack(
            $service,
            $serviceMethod
        );

        $this->slim->map($routeName, function () use ($method) {
            $method($this->slim->router()->getCurrentRoute()->getParams());
        })->via(array_walk($httpMethods, function ($value) {
            return $value;
        }));

        $service->setUp();
    }

    public function initialize()
    {
        $this->slim->run();
    }

    private function getServiceInstance($serviceClassName)
    {
        if (! $this->isClassDefined($serviceClassName)) {
            throw new \Exception('Service not found');
        }

        return new $serviceClassName();
    }

    private function getServiceMethodCallBack(\Centralino\Service\ServiceInterface $service, $serviceMethod)
    {
        if (! method_exists($service, $serviceMethod)) {
            throw new \Exception('Service method not found');
        }

        return function ($params) use ($service, $serviceMethod) {
            $service->$serviceMethod($params);
        };
    }
}
