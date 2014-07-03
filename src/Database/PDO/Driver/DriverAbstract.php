<?php
namespace Centralino\Database\PDO\Driver;

use Centralino\Utility;

abstract class DriverAbstract
{
    protected $host;
    protected $dbname;
    protected $dbuser;
    protected $dbpass;
    protected $options;

    public function __construct($host = '', $port = '', $dbname = '', $dbuser = '', $dbpass = '', $options = array())
    {
        $this->host     = $host;
        $this->port     = $port;
        $this->dbname   = $dbname;
        $this->dbuser   = $dbuser;
        $this->dbpass   = $dbpass;
        $this->options  = $options;
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
}