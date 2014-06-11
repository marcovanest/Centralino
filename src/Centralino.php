<?php
namespace Centralino;

class Centralino
{
    private $container;

    public function __construct()
    {

    }

    public function initialize()
    {
        $this->container['logger'] = new Centralino\Core\Logger\DefaultLogger(LOG_DIR . DS . 'tests', 'database.log');
        t
    }
}