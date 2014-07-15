<?php
namespace Centralino;

class Centralino
{
    public function __construct()
    {

    }

    public function getServiceRegistry()
    {
        return new Service\Registry();
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
