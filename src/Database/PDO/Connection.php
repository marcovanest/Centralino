<?php
namespace Centralino\Database\PDO;

use Centralino\Database\PDO\Driver;

class Connection
{
    CONST DEFAULT_ERROR_MODE = \PDO::ERRMODE_EXCEPTION;

    private $driver;
    private $pdo;

    public function __construct(Driver\DriverInterface $driver)
    {
        $this->driver = $driver;
    }

    public function create()
    {
        try{
            $this->pdo = new \PDO($this->driver->getDsn(), $this->driver->getDBUser(), $this->driver->getDBPass(), $this->driver->getDBOptions());
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, self::DEFAULT_ERROR_MODE);
            $this->pdo->query("SET NAMES 'utf8'");
        }catch(\PDOException $exception) {
            throw new \Centralino\Database\DatabaseException("Db connection failed", 'critical');
        }
    }

    public function getPDOInstance()
    {
        return $this->pdo;
    }
}