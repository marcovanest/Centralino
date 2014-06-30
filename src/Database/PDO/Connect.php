<?php
namespace Centralino\Database\PDO;

class Connect extends \PDO
{
    CONST DEFAULT_ERROR_MODE = \PDO::ERRMODE_EXCEPTION;

    public function __construct($dsn = '', $user = '', $password = '', $options = array())
    {
        parent::__construct($dsn, $user, $password, $options);
        $this->setAttribute(\PDO::ATTR_ERRMODE, self::DEFAULT_ERROR_MODE);
    }
}