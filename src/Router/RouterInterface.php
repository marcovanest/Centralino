<?php
namespace Centralino\Router;

interface RouterInterface
{
    public function registerRoutes(\Centralino\Router\Route\Registry $routeRegistry);
    public function registerRoute($route);
    public function initialize();
}
