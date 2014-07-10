<?php
namespace Statement;

class InitializableTest extends \PHPUnit_Framework_TestCase
{
    public function testIs_Initializable()
    {
        $pdoStatementMock = $this->getMockBuilder('\PDOStatement')
                                    ->getMock();

        $pdoStatementMock->expects($this->any())
                ->method('execute')
                ->will($this->returnValue(true));

        $stm = new \Centralino\Database\PDO\PDOStatement($pdoStatementMock);

        $this->assertInstanceOf('\Centralino\Database\PDO\PDOStatement', $stm);
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testInitialize_With_Wrong_Arguments_Throws()
    {
        $pdoStatementMock = $this->getMockBuilder('\PDOStatement')
                                    ->getMock();

        $stm = new \Centralino\Database\PDO\PDOStatement($pdoStatementMock, array(1,3));
    }

    public function testInitialize_With_Valid_Arguments()
    {
        $pdoStatementMock = $this->getMockBuilder('\PDOStatement')
                                    ->getMock();

        $args = new \Centralino\Utility\CentralinoArray(array(1,2,3));

        $stm  = new \Centralino\Database\PDO\PDOStatement($pdoStatementMock, $args);
        $this->assertInstanceOf('\Centralino\Database\PDO\PDOStatement', $stm);
    }

    public function testGet_Fetch_Mode_Default()
    {
        $pdoStatementMock = $this->getMockBuilder('\PDOStatement')
                            ->getMock();

        $stm = new \Centralino\Database\PDO\PDOStatement($pdoStatementMock);

        $this->assertEquals(\PDO::FETCH_OBJ, $stm->getFetchMode());
    }

    public function testGet_Number_Of_Affected_Rows()
    {
        $manager = $this->getPdoMock(array(1));

        $stm = $manager->select('SELECT * FROM LOG');

        $this->assertEquals(1, $stm->getNumberOfAffectedRows());
    }

    private function getPdoMock($result)
    {
        $stmtMock = $this->getMockBuilder('\PDOStatement')
                        ->setMethods(array('execute', 'fetch', 'rowCount'))
                        ->getMock();

        $stmtMock->expects($this->any())
                ->method('execute')
                ->will($this->returnValue(true));

        $stmtMock->expects($this->any())
                ->method('fetch')
                ->will($this->returnValue($result));

        $stmtMock->expects($this->any())
                ->method('rowCount')
                ->will($this->returnValue(1));

        $pdoMock = $this->getMockBuilder('\Centralino\Database\PDO\_files\PDOMock')
                        ->setMethods(array('prepare'))
                        ->getMock();

        $pdoMock->expects($this->any())
                ->method('prepare')
                ->will($this->returnValue($stmtMock));

        $manager = new \Centralino\Database\PDO\Manager($pdoMock);

        return $manager;
    }
}
