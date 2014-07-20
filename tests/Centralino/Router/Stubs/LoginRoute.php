<?php
namespace Centralino\Router\Stubs;

class LoginRoute implements \Centralino\Router\Route\RouteInterface
{
    public function routes()
    {
        return array(
            array(
                'route' => '/login/:name/:lastname',
                'httpmethods' => array('POST', 'GET'),
                'service' => '\Centralino\Router\LoginService',
                'method' => 'login'
            )
        );
    }
}
