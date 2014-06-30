<?php
namespace Centralino\Database\Pdo\Driver;

interface DriverInterface
{
    public function connect();
    public function dsn();
}