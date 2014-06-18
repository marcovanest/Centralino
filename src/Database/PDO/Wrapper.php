<?php
namespace Centralino\Database\PDO;

use Centralino\Database;
use Psr\Log;

class Wrapper implements WrapperInterface
{
    CONST DEFAULT_FETCH_MODE    = \PDO::FETCH_OBJ;
    CONST CHAR_ENCODING         = 'utf8mb4';
    /**
     * Database PDO instance, handler
     */
    private $pdoInstance;

    private $statement;

    public function __construct(\PDO $pdoInstance) {
        $this->pdoInstance = $pdoInstance;

        if($this->pdoInstance->getAttribute(\PDO::ATTR_ERRMODE) !== \PDO::ERRMODE_EXCEPTION) {
            throw new Database\DatabaseException('Wrong PDO error mode', Log\LogLevel::CRITICAL);
        }
    }

    public function getPdoInstance()
    {
        return $this->pdoInstance;
    }

    public function prepare($statement)
    {
        if ( ! is_string($statement)) {
            throw new Database\DatabaseException('Statement must be string', Log\LogLevel::CRITICAL);
        }

        $this->statement = new Statement($this->pdoInstance, $statement);

        return $this->statement;
    }

    public function select(
        $sqlStatement = '',
        $sqlParams = array(),
        $fetchMode = self::DEFAULT_FETCH_MODE,
        $fetchParam = null
    ) {
        $statement = $this->prepareAndExecute($sqlStatement, $sqlParams);
        $statement->setFetchMode($fetchMode, $fetchParam);
        return $statement;
    }

    public function update($sqlStatement = '', $sqlParams = array())
    {
        return $this->prepareAndExecute($sqlStatement, $sqlParams);
    }

    public function delete($sqlStatement = '', $sqlParams = array())
    {
        return $this->prepareAndExecute($sqlStatement, $sqlParams);
    }

    private function prepareAndExecute($sqlStatement, $sqlParams)
    {
        try {
            $statement = $this->prepare($sqlStatement);
            $statement->execute($sqlParams);

            return $statement;
        }catch(Database\DatabaseException $exception) {
            throw new Database\DatabaseException('Statement failed to prepare or execute', Log\LogLevel::CRITICAL);
        }
    }
}