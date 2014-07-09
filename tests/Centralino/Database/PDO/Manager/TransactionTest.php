<?php
namespace CentralinoManager;

class TransactionTest extends \PHPUnit_Framework_TestCase
{
    private $connection;

    public function setUp()
    {
        $connectionParams = array(
                'host'=>'localhost',
                'port'=>null,
                'dbname'=>'benny_test',
                'dbuser'=>'postgres',
                'dbpass'=>'tar',
                'options'=>array()
            );

        $this->connection = \Centralino\Database\Connection::createPDOConnection('pgsql', $connectionParams);
    }

    public function testStart_Transaction()
    {
        $result = $this->connection->transactionStart();

        $this->assertTrue($result);
        $this->assertTrue($this->connection->inTransaction()->isTrue());
    }

    public function testCommit_Transaction()
    {
        $this->connection->transactionStart();
        $result = $this->connection->transactionCommit();

        $this->assertTrue($result);
        $this->assertTrue($this->connection->inTransaction()->isFalse());
    }

    public function testRollback_Transaction()
    {
        $this->connection->transactionStart();
        $result = $this->connection->transactionRollback();

        $this->assertTrue($result);
        $this->assertTrue($this->connection->inTransaction()->isFalse());
    }

    public function testIn_Transaction()
    {
        $this->connection->transactionStart();

        $result = $this->connection->inTransaction();
        $this->assertTrue($result->isTrue());

        $this->connection->transactionCommit();

        $result = $this->connection->inTransaction();
        $this->assertTrue($result->isFalse());
    }

    /**
     * @expectedException Centralino\Database\DatabaseException
     */
    public function testNested_Transaction_Not_Allowed_Throws()
    {
        $this->connection->transactionStart();

        $this->connection->transactionStart();
    }
}
