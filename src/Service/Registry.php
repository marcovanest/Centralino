<?php
namespace Centralino\Service;

class Registry
{
    private $services;

    public function __construct()
    {
        $this->services = new \Centralino\Utility\CentralinoArray(array());
    }

    public function addService($serviceName, $serviceClassName)
    {
        if (! isset($this->services[$serviceName])) {
            $this->services[$serviceName] = $serviceClassName;
        }

        return true;
    }

    public function getService($serviceName)
    {
        if (isset($this->services[$serviceName])) {
            return $this->services[$serviceName];
        }
    }

    public function getRegisteredServices()
    {
        return $this->services;
    }
}
