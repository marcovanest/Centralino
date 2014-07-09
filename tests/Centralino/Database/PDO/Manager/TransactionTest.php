<?php
namespace CentralinoManager;

class TransactionTest extends \PHPUnit_Framework_TestCase
{
    public function testStart_Transaction()
    {
        $pdoMock = $this->getPdoMock();

        $pdoMock->expects($this->any())
                ->method('inTransaction')
                ->will($this->returnValue(false));

        $pdoMock->expects($this->any())
                ->method('beginTransaction')
                ->will($this->returnValue(true));

        $manager = new \Centralino\Database\PDO\Manager($pdoMock);
        $this->assertTrue($manager->transactionStart());
    }

    /**
     * @expectedException Centralino\Database\DatabaseException
     */
    public function testStart_Transaction_Failed_Throws()
    {
        $pdoMock = $this->getPdoMock();

        $pdoMock->expects($this->any())
                ->method('inTransaction')
                ->will($this->returnValue(false));

        $pdoMock->expects($this->any())
                ->method('beginTransaction')
                ->will($this->returnValue(false));

        $manager = new \Centralino\Database\PDO\Manager($pdoMock);
        $manager->transactionStart();
    }

    /**
     * @expectedException Centralino\Database\DatabaseException
     */
    public function testCommit_Transaction_Failed_Throws()
    {
        $pdoMock = $this->getPdoMock();

        $pdoMock->expects($this->any())
                ->method('inTransaction')
                ->will($this->returnValue(false));

        $pdoMock->expects($this->any())
                ->method('commit')
                ->will($this->returnValue(false));

        $pdoMock->expects($this->any())
                ->method('rollback')
                ->will($this->returnValue(true));

        $manager = new \Centralino\Database\PDO\Manager($pdoMock);
        $manager->transactionCommit();
    }

    /**
     * @expectedException Centralino\Database\DatabaseException
     */
    public function testRollback_Transaction_Failed_Throws()
    {
        $pdoMock = $this->getPdoMock();

        $pdoMock->expects($this->any())
                ->method('inTransaction')
                ->will($this->returnValue(false));

        $pdoMock->expects($this->any())
                ->method('rollback')
                ->will($this->returnValue(false));

        $manager = new \Centralino\Database\PDO\Manager($pdoMock);
        $manager->transactionRollback();
    }

    public function testCommit_Transaction()
    {
        $pdoMock = $this->getPdoMock();

        $pdoMock->expects($this->any())
                ->method('inTransaction')
                ->will($this->returnValue(false));

        $pdoMock->expects($this->any())
                ->method('beginTransaction')
                ->will($this->returnValue(true));

        $pdoMock->expects($this->any())
                ->method('commit')
                ->will($this->returnValue(true));

        $manager = new \Centralino\Database\PDO\Manager($pdoMock);
        $manager->transactionStart();
        $this->assertTrue($manager->transactionCommit());
    }

    public function testRollback_Transaction()
    {
        $pdoMock = $this->getPdoMock();

        $pdoMock->expects($this->any())
                ->method('inTransaction')
                ->will($this->returnValue(false));

        $pdoMock->expects($this->any())
                ->method('beginTransaction')
                ->will($this->returnValue(true));

        $pdoMock->expects($this->any())
                ->method('rollback')
                ->will($this->returnValue(true));

        $manager = new \Centralino\Database\PDO\Manager($pdoMock);
        $manager->transactionStart();
        $this->assertTrue($manager->transactionRollback());
    }

    public function testIn_Transaction()
    {
        $pdoMock = $this->getPdoMock();

        $pdoMock->expects($this->exactly(3))
                ->method('inTransaction')
                ->will($this->onConsecutiveCalls(false, true, false));

        $pdoMock->expects($this->any())
                ->method('beginTransaction')
                ->will($this->returnValue(true));

        $pdoMock->expects($this->any())
                ->method('commit')
                ->will($this->returnValue(true));

        $manager = new \Centralino\Database\PDO\Manager($pdoMock);
        $manager->transactionStart();
        $this->assertTrue($manager->inTransaction()->isTrue());

        $manager->transactionCommit();
        $this->assertTrue($manager->inTransaction()->isFalse());
    }

    /**
     * @expectedException Centralino\Database\DatabaseException
     */
    public function testNested_Transaction_Not_Allowed_Throws()
    {
        $pdoMock = $this->getPdoMock();

        $pdoMock->expects($this->exactly(2))
                ->method('inTransaction')
                ->will($this->onConsecutiveCalls(false, true));

        $pdoMock->expects($this->any())
                ->method('beginTransaction')
                ->will($this->returnValue(true));

        $manager = new \Centralino\Database\PDO\Manager($pdoMock);
        $manager->transactionStart();
        $manager->transactionStart();
    }

    private function getPdoMock()
    {
        $pdoMock = $this->getMockBuilder('\Centralino\Database\PDO\_files\PDOMock')
                        ->setMethods(array('beginTransaction', 'commit', 'rollback', 'inTransaction'))
                        ->getMock();

        return $pdoMock;
    }
}
