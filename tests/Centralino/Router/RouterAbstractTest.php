<?php
namespace Router;

class RouterAbstractTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Exception
     * @expectedExceptionMessage No routes supplied by the registry
     */
    public function testRegisterRoutes_With_No_Registered_Routes()
    {
        $stubRouteRegistry = $this->getMockBuilder('\Centralino\Router\Route\Registry')
            ->getMock();

        $stub = $this->getMockForAbstractClass('\Centralino\Router\RouterAbstract');
        $stub->expects($this->any())
            ->method('registerRoute')
            ->will($this->returnValue(TRUE));

        $stub->registerRoutes($stubRouteRegistry);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Invalid route given
     */
    public function testRegisterRoutes_With_Invalid_Registered_Routes()
    {
        $stubRouteRegistry = $this->getMockBuilder('\Centralino\Router\Route\Registry')
            ->getMock();

        $stubRouteRegistry->expects($this->any())
            ->method('getRegisteredRoutes')
            ->will($this->returnValue(array('login' => 'App\Route\Lodgin')));


        $stub = $this->getMockForAbstractClass('\Centralino\Router\RouterAbstract');
        $stub->expects($this->any())
            ->method('registerRoute')
            ->will($this->returnValue(TRUE));

        $stub->registerRoutes($stubRouteRegistry);
    }

    public function testRegisterRoutes_With_Valid_Registered_Routes()
    {
        $stubRouteRegistry = $this->getMockBuilder('\Centralino\Router\Route\Registry')
            ->getMock();

        $stubRouteRegistry->expects($this->once())
            ->method('getRegisteredRoutes')
            ->will($this->returnValue(array('login' => 'Centralino\Router\Stubs\LoginRoute')));

        $stub = $this->getMockForAbstractClass('\Centralino\Router\RouterAbstract');
        $stub->expects($this->once())
            ->method('registerRoute')
            ->will($this->returnValue(TRUE));

        $stub->registerRoutes($stubRouteRegistry);
    }

}
