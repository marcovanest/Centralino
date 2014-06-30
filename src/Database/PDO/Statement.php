<?php
namespace Centralino\Database\PDO;

use Centralino\Database;
use Psr\Log;

class Statement extends \PDOStatement
{
    CONST DEFAULT_FETCH_MODE = \PDO::FETCH_OBJ;

    private $handle;
    private $sqlStatement;
    private $pdoStatement;
    private $fetchMode = self::DEFAULT_FETCH_MODE;
    private $fetchParam = null;

    public function __construct(\PDO $handle, $sqlStatement, $options = array())
    {
        $this->handle       = $handle;
        $this->sqlStatement = $sqlStatement;
        $this->pdoStatement = $this->handle->prepare($sqlStatement, $options);
    }

    public function setFetchMode($mode, $param = null)
    {
        if( ! in_array($mode, array(
            \PDO::FETCH_ASSOC,
            \PDO::FETCH_BOTH,
            \PDO::FETCH_BOUND,
            \PDO::FETCH_CLASS,
            \PDO::FETCH_INTO,
            \PDO::FETCH_LAZY,
            \PDO::FETCH_NAMED,
            \PDO::FETCH_NUM,
            \PDO::FETCH_OBJ
            ))
        ) {
            throw new Database\DatabaseException('Invalid fetch mode', Log\LogLevel::CRITICAL);
        }

        $this->fetchMode    = $mode;
        $this->fetchParam   = $param;

        if( empty($this->fetchParam)) {
            $this->pdoStatement->setFetchMode($this->fetchMode);
        }else {
            $this->pdoStatement->setFetchMode($this->fetchMode, $this->fetchParam);
        }
    }

    public function getFetchMode()
    {
        return $this->fetchMode;
    }

    public function execute($aParams = array())
    {
        $sqlStatementParamHolderCount = substr_count($this->sqlStatement, '?');
        $paramCount = count($aParams);

        if($sqlStatementParamHolderCount != $paramCount) {
            throw new Database\DatabaseException('Wrong parameter count', Log\LogLevel::CRITICAL);
        }

        try {
            return $this->pdoStatement->execute($aParams);
        }catch(\PDOException $exception) {
            throw new Database\DatabaseException('Statement failed to execute', Log\LogLevel::CRITICAL);
        }
    }

    public function getNumberOfAffectedRows()
    {
        return $this->pdoStatement->rowCount();
    }

    public function nextRow($cursor_orientation = \PDO::FETCH_ORI_NEXT, $cursor_offset = 0)
    {
        return $this->pdoStatement->fetch($this->fetchMode, $cursor_orientation, $cursor_offset);
    }

    public function allRows()
    {
        return $this->pdoStatement->fetchAll();
    }
}