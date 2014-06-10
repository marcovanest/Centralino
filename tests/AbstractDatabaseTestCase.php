<?php
namespace Tests;

use Centralino;

abstract class AbstractDatabaseTestCase extends \PHPUnit_Extensions_Database_TestCase
{
    const DB_NAME   = 'benny_test';
    const DB_HOST   = 'localhost';
    const DB_USER   = 'postgres';
    const DB_PASS   = 'tar';
    const DB_DRIVER = 'pgsql';

    public function createDBConnection()
    {
        $pdoInstance    = new \PDO(self::DB_DRIVER . ':dbname=' . self::DB_NAME . ';host=' . self::DB_HOST . ';user=' . self::DB_USER . ';password=' . self::DB_PASS . '');
        $pdoInstance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return new Centralino\Database\PDO\Wrapper($pdoInstance);
    }

    public function selectNextRow($instance, $sql, $fetchMode, $fetchParam = null)
    {
        if(is_null($fetchParam)) {
            $statement = $instance->select($sql, $fetchMode);
        }else {
            $statement = $instance->select($sql, $fetchMode, $fetchParam);
        }

        $result = $statement->nextRow();
        $statement->closeCursor();

        return $result;
    }
}