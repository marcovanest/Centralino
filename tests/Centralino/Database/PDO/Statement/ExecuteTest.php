<?php
namespace Statement;

class ExecuteTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Centralino\Database\DatabaseException
     * @expectedMessage Statement failed to execute
     */
    public function testExecute_Fails_Throws()
    {
        $stmtMock = $this->getMockBuilder('\PDOStatement')
                    ->getMock();

        $stmtMock->expects($this->any())
                    ->method('execute')
                    ->will($this->throwException(new \PDOException));

        $pdoMock = $this->getMockBuilder('\Centralino\Database\PDO\_files\PDOMock')
                    ->setMethods(array('prepare'))
                    ->getMock();

        $pdoMock->expects($this->any())
                    ->method('prepare')
                    ->will($this->returnValue($stmtMock));

        $manager = new \Centralino\Database\PDO\Manager($pdoMock);

        $stm = $manager->select('SELECT * FROM LOG');
        $stm->execute();
    }

    /**
     * @expectedException Centralino\Database\DatabaseException
     * @expectedMessage Statement failed to execute
     */
    public function testExecute_Returns_False_Throws()
    {
        $stmtMock = $this->getMockBuilder('\PDOStatement')
                    ->getMock();

        $stmtMock->expects($this->any())
                    ->method('execute')
                    ->will($this->returnValue(false));

        $pdoMock = $this->getMockBuilder('\Centralino\Database\PDO\_files\PDOMock')
                    ->setMethods(array('prepare'))
                    ->getMock();

        $pdoMock->expects($this->any())
                    ->method('prepare')
                    ->will($this->returnValue($stmtMock));

        $manager = new \Centralino\Database\PDO\Manager($pdoMock);

        $stm = $manager->select('SELECT * FROM LOG');
        $stm->execute();
    }

    public function testExecute_Succes_Returns_Centralino_PDOStatement()
    {
        $stmtMock = $this->getMockBuilder('\PDOStatement')
                    ->getMock();

        $stmtMock->expects($this->any())
                    ->method('execute')
                    ->will($this->returnValue(true));

        $pdoMock = $this->getMockBuilder('\Centralino\Database\PDO\_files\PDOMock')
                    ->setMethods(array('prepare'))
                    ->getMock();

        $pdoMock->expects($this->any())
                    ->method('prepare')
                    ->will($this->returnValue($stmtMock));

        $manager = new \Centralino\Database\PDO\Manager($pdoMock);

        $stm = $manager->select('SELECT * FROM LOG');
        $this->assertInstanceOf('\Centralino\Database\PDO\PDOStatement', $stm->execute());
    }
}
