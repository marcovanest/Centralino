<?php
namespace Centralino\Database\PDO;

use Centralino\Database\PDO\Driver;

class PDOConnection
{
    const DEFAULT_ERROR_MODE = \PDO::ERRMODE_EXCEPTION;

    private $driver;

    public function __construct(Driver\DriverInterface $driver)
    {
        $this->driver = $driver;
    }

    public function create()
    {
        try {
            $pdo = new \PDO($this->driver->getDsn(), $this->driver->getDBUser(), $this->driver->getDBPass(), $this->driver->getDBOptions());
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, self::DEFAULT_ERROR_MODE);
            $pdo->query("SET NAMES 'utf8'");
        } catch (\PDOException $exception) {
            throw new \Centralino\Database\DatabaseException("Db connection failed", 'critical');
        }

        return $pdo;
    }
}
