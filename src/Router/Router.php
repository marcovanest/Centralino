<?php
namespace Centralino\Router;

class Router extends \Slim\Slim
{
    public function __construct()
    {
        parent::__construct();
    }

    public function initRoutesFromServices(\Centralino\Service\Registry $serviceRegistry)
    {
        $registeredServices = $serviceRegistry->getRegisteredServices();

        foreach ($registeredServices as $serviceClassName) {

            if (! class_exists($serviceClassName)) {
                throw new \Exception('Invalid service given');
            }

            $service = new $serviceClassName();
            $routes  = $service->routes();

            foreach ($routes as $implementation) {
                $this->initRoute($service, $implementation);
            }
        }

        $this->run();
    }

    private function initRoute($service, $implementation)
    {
        $route = $implementation['route'];
        $httpMethods = $implementation['httpmethods'];
        $serviceMethod = $implementation['method'];

        if (! method_exists($service, $serviceMethod)) {
            throw new \Exception('Route has no valid service method implementation');
        }

        $this->map($route, function () use ($service, $serviceMethod) {
            $routeParameters = $this->router()->getCurrentRoute()->getParams();
            $service->{$serviceMethod}($routeParameters);
        })->via(array_walk($httpMethods, function ($value) {
            return $value;
        }));
    }
}
