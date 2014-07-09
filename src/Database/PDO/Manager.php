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

        if ($result->isFalse()) {
            throw new Database\DatabaseException('Invalid update statement', Log\LogLevel::CRITICAL);
        }

        $statement = $this->prep($statement, $params);
        return $statement->execute();
    }

    public function delete($statement, $params = array())
    {
        $result = $this->isValidStatement($statement, $params);

        if ($result->isFalse()) {
            throw new Database\DatabaseException('Invalid delete statement', Log\LogLevel::CRITICAL);
        }

        $statement = $this->prep($statement, $params);
        return $statement->execute();
    }

    public function transactionStart()
    {
        if ($this->inTransaction()->isTrue()) {
            throw new Database\DatabaseException('Already in transaction', Log\LogLevel::CRITICAL);
        }

        $result = new Utility\CentralinoBoolean($this->pdoInstance->beginTransaction());

        if ($result->isFalse()) {
            throw new Database\DatabaseException('Transaction failed to start', Log\LogLevel::CRITICAL);
        }

        return true;
    }

    public function transactionCommit()
    {
        $result = new Utility\CentralinoBoolean($this->pdoInstance->commit());

        if ($result->isFalse()) {
            $this->transactionRollback();
            throw new Database\DatabaseException('Transaction failed to commit', Log\LogLevel::CRITICAL);
        }

        return true;
    }

    public function transactionRollback()
    {
        $result = new Utility\CentralinoBoolean($this->pdoInstance->rollback());

        if ($result->isFalse()) {
            throw new Database\DatabaseException('Transaction failed to rollback', Log\LogLevel::CRITICAL);
        }

        return true;
    }

    public function inTransaction()
    {
        return new Utility\CentralinoBoolean($this->pdoInstance->inTransaction());
    }

    private function prep($statement, $params = array())
    {
        $sqlStatement   = new Utility\CentralinoString($statement);
        $params         = new Utility\CentralinoArray($params);

        $pdoStatement = $this->pdoInstance->prepare($sqlStatement->get());
        return new PDOStatement($pdoStatement, $params);
    }

    private function isValidStatement($statement, $params)
    {
        if ($this->isValidQueryStatement($statement) === false) {
            throw new Database\DatabaseException('Invalid query statement string', Log\LogLevel::CRITICAL);
        }

        if ($this->isValidQueryParameters($params) === false) {
            throw new Database\DatabaseException('Invalid query parameters', Log\LogLevel::CRITICAL);
        }

        $sqlStatementParamHolderCount   = substr_count($statement, '?');
        $paramCount                     = count($params);

        return new Utility\CentralinoBoolean($sqlStatementParamHolderCount === $paramCount);
    }

    private function isValidQueryStatement($statement)
    {
        return Utility\CentralinoString::isString($statement) && Utility\CentralinoString::isEmptyString($statement) === false;
    }

    private function isValidQueryParameters($params)
    {
        return Utility\CentralinoArray::isArray($params);
    }
}
