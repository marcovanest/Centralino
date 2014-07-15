<?php
namespace Centralino\Router;

interface RouterInterface
{
    public function registerRoutesFromServices(\Centralino\Service\Registry $serviceRegistry);
    public function registerRouteFromService($service, $implementation);
    public function initialize();
}
