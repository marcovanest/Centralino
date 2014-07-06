<?php
namespace Centralino\Database\PDO;

use Centralino\Utility;

class Manager
{
    private $pdoInstance;

    private $transactionStack = array();

    private $transactionId;

    public function __construct(\PDO $pdo)
    {
        $this->pdoInstance = $pdo;
    }

    public function select($statement, $params = array())
    {
        $statement = $this->prep($statement);
    }

    public function update($statement, $params = array())
    {
        $statement = $this->prep($statement);
    }

    public function delete($statement, $params = array())
    {
        $statement = $this->prep($statement);
    }

    public function transactionStart()
    {
        if($this->inTransaction()) {
            throw new \Exception("already in transaction", 1);
        }

        $result = Utility\CentralinoBoolean::create($this->pdoInstance->beginTransaction());

        if($result->isFalse()) {
            throw new \Exception("transaction start failed", 1);
        }
    }

    public function transactionCommit()
    {
        $result = Utility\CentralinoBoolean::create($this->pdoInstance->commit());

        if($result->isFalse()) {
            throw new \Exception("transaction commit failed", 1);
        }
    }

    public function transactionRollback()
    {
        $result = Utility\CentralinoBoolean::create($this->pdoInstance->rollback());

        if($result->isFalse()) {
            throw new \Exception("transaction rollback failed", 1);
        }
    }

    public function inTransaction()
    {
        return Utility\CentralinoBoolean::create($this->pdoInstance->inTransaction());
    }

    private function prep($statement, $params = array())
    {
        $string         = Utility\CentralinoString::create($statement);
        $params         = Utility\CentralinoArray::create($params);

        $pdoStatement   = $this->pdoInstance->prepare($string);

        return new PDOStatement($pdoStatement, $params);
    }
}