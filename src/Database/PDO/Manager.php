<?php
namespace Centralino\Database\PDO;

use Centralino\Database;
use Centralino\Utility;
use Psr\Log;

class Manager
{
    const CURSOR = \PDO::CURSOR_FWDONLY;

    private $pdoInstance;

    public function __construct(\PDO $pdo)
    {
        $this->pdoInstance = $pdo;
    }

    public function select($statement, $inputParams = array())
    {
        $result = $this->isValidStatement($statement, $inputParams);

        if ($result->isFalse()) {
            throw new Database\DatabaseException('Invalid select statement', Log\LogLevel::CRITICAL);
        }

        $statement = $this->prep($statement, $inputParams);
        return $statement->execute();
    }

    public function update($statement, $inputParams = array())
    {
        $result = $this->isValidStatement($statement, $inputParams);

        if ($result->isFalse()) {
            throw new Database\DatabaseException('Invalid update statement', Log\LogLevel::CRITICAL);
        }

        $statement = $this->prep($statement, $inputParams);
        return $statement->execute();
    }

    public function delete($statement, $inputParams = array())
    {
        $result = $this->isValidStatement($statement, $inputParams);

        if ($result->isFalse()) {
            throw new Database\DatabaseException('Invalid delete statement', Log\LogLevel::CRITICAL);
        }

        $statement = $this->prep($statement, $inputParams);
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

    private function prep($statement, $inputParams = array())
    {
        $sqlStatement = new Utility\CentralinoString($statement);
        $inputParams = new Utility\CentralinoArray($inputParams);

        $pdoStatement = $this->pdoInstance->prepare($sqlStatement->get(), array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
        return new PDOStatement($pdoStatement, $inputParams);
    }

    private function isValidStatement($statement, $inputParams)
    {
        if ($this->isValidQueryStatement($statement) === false) {
            throw new Database\DatabaseException('Invalid query statement string', Log\LogLevel::CRITICAL);
        }

        if ($this->isValidQueryInputParameters($inputParams) === false) {
            throw new Database\DatabaseException('Invalid query parameters', Log\LogLevel::CRITICAL);
        }

        $sqlStatementParamHolderCount = substr_count($statement, '?');
        $inputParamCount = count($inputParams);

        return new Utility\CentralinoBoolean($sqlStatementParamHolderCount === $inputParamCount);
    }

    private function isValidQueryStatement($statement)
    {
        return Utility\CentralinoString::isString($statement) && Utility\CentralinoString::isEmptyString($statement) === false;
    }

    private function isValidQueryInputParameters($inputParams)
    {
        return Utility\CentralinoArray::isArray($inputParams);
    }
}
