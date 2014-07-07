<?php
namespace Centralino\Database;

class Connection
{
    public static function createPDOConnection($driver, $connectionParams)
    {
        extract($connectionParams);

        $class  = 'Centralino\Database\PDO\Driver\\'.mb_convert_case($driver, MB_CASE_TITLE, "UTF-8");

        if (! class_exists($class)) {
            throw new DatabaseException("The given driver is either invalid or not implemented", 'critical');
        }

        $driver     = new $class($host, $port, $dbname, $dbuser, $dbpass, $options);

        $connection = new PDO\PDOConnection($driver);

        return new PDO\Manager($connection->create());
    }
}
