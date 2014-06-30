<?php
namespace Centralino\Database\Pdo\Driver;

interface DriverInterface
{
    public function getName();

    public function getDBUser();

    public function getDBPass();

    public function getDBOptions();

    public function getDsn();
}