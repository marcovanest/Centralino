<?php
namespace Centralino\Database;

class Connection
{
    public static function createPDOConnection($driver, $connectionParams)
    {
       extract($connectionParams);

       $class  = 'Centralino\Database\PDO\Driver\\'.mb_convert_case($driver, MB_CASE_TITLE, "UTF-8");
       $driver = new $class($host, $port, $dbname, $dbuser, $dbpass, $options);

       return new PDO\Connection($driver);
    }
}