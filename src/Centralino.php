<?php
namespace Centralino;

class Centralino
{
    public function __construct()
    {

    }

    public function getRouteRegistry()
    {
        return new Router\Route\Registry();
    }

    public function getRouter($type)
    {
        switch ($type) {
            case 'slim':
                return new Router\SlimRouter();
            break;
        }

    }
}
