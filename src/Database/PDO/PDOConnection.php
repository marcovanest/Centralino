<?php
namespace Centralino\Database\PDO;

use Centralino\Database\PDO\Driver;

class PDOConnection extends \PDO
{
    CONST DEFAULT_ERROR_MODE = \PDO::ERRMODE_EXCEPTION;

    public function __construct(Driver\DriverInterface $driver)
    {
        parent::__construct($driver->getDsn(), $driver->getDBUser(), $driver->getDBPass(), $driver->getDBOptions());
        $this->setAttribute(\PDO::ATTR_ERRMODE, self::DEFAULT_ERROR_MODE);
    }

}