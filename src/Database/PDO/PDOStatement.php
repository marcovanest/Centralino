<?php
namespace Centralino\Database\PDO;

use Centralino\Database;
use Psr\Log;

class PDOStatement
{
    CONST DEFAULT_FETCH_MODE = \PDO::FETCH_OBJ;

    private $pdoStatement;
    private $sqlStatement;
    private $sqlStatementParams;
    private $fetchMode = self::DEFAULT_FETCH_MODE;
    private $fetchParam = null;

    public function __construct(\PDOStatement $statement, \Centralino\Utility\CentralinoArray $params = null)
    {
        $this->pdoStatement         = $statement;
        $this->sqlStatement         = $this->pdoStatement->queryString;
        $this->sqlStatementParams   = $params;
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

    public function execute()
    {
        try {
            return $this->pdoStatement->execute($this->sqlStatementParams->get());
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