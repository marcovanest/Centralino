<?php
namespace Centralino\Router;

abstract class RouterAbstract implements RouterInterface
{
    public function registerRoutesFromServices(\Centralino\Service\Registry $serviceRegistry)
    {
        $registeredServices = $serviceRegistry->getRegisteredServices();

        foreach ($registeredServices as $serviceClassName) {

            if (! class_exists($serviceClassName)) {
                throw new \Exception('Invalid service given');
            }

            $service = new $serviceClassName();
            $routes = $service->routes();

            foreach ($routes as $routeImplementation) {
                $this->registerRouteFromService($routeImplementation, function($routeParameters) use ($service, $routeImplementation) {
                    $service->{$routeImplementation['method']}($routeParameters);
                });
            }
        }
    }
}
