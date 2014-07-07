<?php
namespace Centralino\Database\PDO;

use Centralino\Database;
use Centralino\Utility;
use Psr\Log;

class Manager
{
    private $pdoInstance;

    public function __construct(\PDO $pdo)
    {
        $this->pdoInstance = $pdo;
    }

    public function select($statement, $params = array())
    {
        $result = $this->isValidStatement($statement, $params);

        if ($result->isFalse()) {
            throw new Database\DatabaseException('Invalid select statement', Log\LogLevel::CRITICAL);
        }

        $statement = $this->prep($statement, $params);
        return $statement->execute();
    }

    public function update($statement, $params = array())
    {
        $result = $this->isValidStatement($statement, $params);

        if ($result->isTrue()) {
            throw new Database\DatabaseException('Invalid update statement', Log\LogLevel::CRITICAL);
        }

        $statement = $this->prep($statement, $params);
    }

    public function delete($statement, $params = array())
    {
        $result = $this->isValidStatement($statement, $params);

        if ($result->isTrue()) {
            throw new Database\DatabaseException('Invalid delete statement', Log\LogLevel::CRITICAL);
        }

        $statement = $this->prep($statement, $params);
    }

    public function transactionStart()
    {
        if ($this->inTransaction()) {
            throw new \Exception("already in transaction", 1);
        }

        $result = Utility\CentralinoBoolean::create($this->pdoInstance->beginTransaction());

        if ($result->isFalse()) {
            throw new \Exception("transaction start failed", 1);
        }
    }

    public function transactionCommit()
    {
        $result = Utility\CentralinoBoolean::create($this->pdoInstance->commit());

        if ($result->isFalse()) {
            throw new \Exception("transaction commit failed", 1);
        }
    }

    public function transactionRollback()
    {
        $result = Utility\CentralinoBoolean::create($this->pdoInstance->rollback());

        if ($result->isFalse()) {
            throw new \Exception("transaction rollback failed", 1);
        }
    }

    public function inTransaction()
    {
        return Utility\CentralinoBoolean::create($this->pdoInstance->inTransaction());
    }

    private function prep($statement, $params = array())
    {
        $sqlStatement   = Utility\CentralinoString::create($statement);
        $params         = Utility\CentralinoArray::create($params);

        $pdoStatement = $this->pdoInstance->prepare($sqlStatement->get());
        return new PDOStatement($pdoStatement, $params);
    }

    private function isValidStatement($statement, $params)
    {
        $sqlStatement   = Utility\CentralinoString::create($statement);
        $params         = Utility\CentralinoArray::create($params);

        $sqlStatementParamHolderCount   = substr_count($sqlStatement->get(), '?');
        $paramCount                     = count($params);

        return Utility\CentralinoBoolean::create($sqlStatementParamHolderCount === $paramCount);
    }
}
