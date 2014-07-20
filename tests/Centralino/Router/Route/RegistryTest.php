<?php
namespace Router\Route;

class RouteRegistryTest extends \PHPUnit_Framework_TestCase
{
    public function testInit()
    {
        $routeRegistry = new \Centralino\Router\Route\Registry();
        $this->assertInstanceOf('\Centralino\Router\Route\Registry', $routeRegistry);
    }

    public function testAddRoute()
    {
        $routeRegistry = new \Centralino\Router\Route\Registry();
        $routeRegistry->addRoute('login', '\App\Route\Login');

        $this->assertEquals('\App\Route\Login', $routeRegistry->getRoute('login'));
    }

    public function testGetRoute_Not_Existing_Return_False()
    {
        $routeRegistry = new \Centralino\Router\Route\Registry();
        $this->assertFalse($routeRegistry->getRoute('login'));
    }

    public function testGetRegisteredRoutes_Is_Instance_Of_CentralinoArray()
    {
        $routeRegistry = new \Centralino\Router\Route\Registry();
        $routeRegistry->addRoute('login', '\App\Route\Login');
        $routeRegistry->addRoute('logout', '\App\Route\Logout');

        $this->assertInstanceOf(
            '\Centralino\Utility\CentralinoArray',
            $routeRegistry->getRegisteredRoutes()
        );
    }

    public function testGetRegisteredRoutes()
    {
        $routeRegistry = new \Centralino\Router\Route\Registry();
        $routeRegistry->addRoute('login', '\App\Route\Login');
        $routeRegistry->addRoute('logout', '\App\Route\Logout');

        $this->assertEquals(
            array(
                'login' => '\App\Route\Login',
                'logout' => '\App\Route\Logout'
            ),
            $routeRegistry->getRegisteredRoutes()->get()
        );
    }
}
