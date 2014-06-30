<?php
namespace Centralino\Database\PDO\Driver;

class Pgsql extends DriverAbstract implements DriverInterface
{
    public function __construct($host = '', $port = '', $dbname = '', $dbuser = '', $dbpass = '', $options = array())
    {
        parent::__construct($host, $port, $dbname, $dbuser, $dbpass, $options);
    }

    public function getName()
    {
        return 'pgsql';
    }

    public function getDsn()
    {
        $dsn = $this->getName().':';

        if( ! empty($this->host) ) {
            $dsn .= 'host=' . $this->host . ';';
        }

        if( ! empty($this->port) ) {
            $dsn .= 'port=' . $this->port . ';';
        }

        if( ! empty($this->dbname) ) {
            $dsn .= 'dbname=' . $this->dbname . ';';
        }

        return $dsn;
    }
}