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

    /**
     * @expectedException Centralino\Database\DatabaseException
     */
    public function testStart_Transaction_Failed_Throws()
    {
        $PDOstub = $this->getDbStub();

        $PDOstub->expects($this->any())
                ->method('inTransaction')
                ->will($this->returnValue(false));

        $PDOstub->expects($this->any())
                ->method('beginTransaction')
        ->will($this->returnValue(false));

        $manager = new \Centralino\Database\PDO\Manager($PDOstub);
        $manager->transactionStart();
    }

    /**
     * @expectedException Centralino\Database\DatabaseException
     */
    public function testCommit_Transaction_Failed_Throws()
    {
        $PDOstub = $this->getDbStub();

        $PDOstub->expects($this->any())
                ->method('inTransaction')
                ->will($this->returnValue(false));

        $PDOstub->expects($this->any())
                ->method('commit')
        ->will($this->returnValue(false));

        $manager = new \Centralino\Database\PDO\Manager($PDOstub);
        $manager->transactionCommit();
    }

    /**
     * @expectedException Centralino\Database\DatabaseException
     */
    public function testRollback_Transaction_Failed_Throws()
    {
        $PDOstub = $this->getDbStub();

        $PDOstub->expects($this->any())
                ->method('inTransaction')
                ->will($this->returnValue(false));

        $PDOstub->expects($this->any())
                ->method('rollback')
        ->will($this->returnValue(false));

        $manager = new \Centralino\Database\PDO\Manager($PDOstub);
        $manager->transactionRollback();
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

    private function getDbStub()
    {
        $PDOstub = $this->getMockBuilder('\Centralino\Database\PDO\_files\PDOMock')
                            ->setMethods(array('beginTransaction', 'commit', 'rollback', 'inTransaction'))
                            ->getMock();

        return $PDOstub;
    }
}
