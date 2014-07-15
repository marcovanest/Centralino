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

    public function initializeRouter()
    {
        return new Router\Router();
    }
}
