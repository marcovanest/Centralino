<?php
namespace Centralino\Database\PDO\Driver;

class Pgsql implements DriverInterface
{
    private $host;
    private $dbname;
    private $dbuser;
    private $dbpass;
    private $options;

    public function __construct($host = '', $port = '', $dbname = '', $dbuser = '', $dbpass = '', $options = array())
    {
        $this->host     = $host;
        $this->port     = $port;
        $this->dbname   = $dbname;
        $this->dbuser   = $dbuser;
        $this->dbpass   = $dbpass;
        $this->options  = $options;
    }

    public function getName()
    {
        return 'pgsql';
    }

    public function getDBUser()
    {
        return $this->dbuser;
    }

    public function getDBPass()
    {
        return $this->dbpass;
    }

    public function getDBOptions()
    {
        return $this->options;
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

    public function connect()
    {
        return new \Centralino\Database\PDO\PDOConnection($this);
    }
}