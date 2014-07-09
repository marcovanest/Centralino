<?php
namespace Statement;

class InitializableTest extends \PHPUnit_Framework_TestCase
{
    public function testIs_Initializable()
    {
        $pdoStatementMock = $this->getMockBuilder('\PDOStatement')
                                    ->getMock();

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
        $manager = $this->getDbStub(array(1));

        $stm = $manager->select('SELECT * FROM LOG');

        $this->assertEquals(1, $stm->getNumberOfAffectedRows());
    }

    private function getDbStub($result)
    {
        $STMTstub = $this->getMockBuilder('\PDOStatement')
                        ->setMethods(array('fetch', 'rowCount'))
                        ->getMock();

        $STMTstub->expects($this->any())
                ->method('fetch')
                ->will($this->returnValue($result));

        $STMTstub->expects($this->any())
                ->method('rowCount')
                ->will($this->returnValue(1));

        $PDOstub = $this->getMockBuilder('\Centralino\Database\PDO\_files\PDOMock')
                            ->setMethods(array('execute', 'prepare'))
                            ->getMock();

        $PDOstub->expects($this->any())
                ->method('execute')
                ->will($this->returnValue(true));

        $PDOstub->expects($this->any())
                ->method('prepare')
                ->will($this->returnValue($STMTstub));

        $manager = new \Centralino\Database\PDO\Manager($PDOstub);

        return $manager;
    }
}
