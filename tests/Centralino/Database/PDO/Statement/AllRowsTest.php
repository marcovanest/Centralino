<?php
namespace Statement;

class AllRowsTest extends \PHPUnit_Framework_TestCase
{
    public function testAllRows()
    {
        $manager = $this->getPdoMock(array(1));

        $stm = $manager->select('SELECT * FROM LOG');

        $this->assertEquals(array(1), $stm->allRows());
    }
    
    private function getPdoMock($result)
    {
        $stmMock = $this->getMockBuilder('\PDOStatement')
                        ->setMethods(array('execute', 'fetchAll'))
                        ->getMock();

        $stmMock->expects($this->any())
                ->method('execute')
                ->will($this->returnValue(true));

        $stmMock->expects($this->any())
                ->method('fetchAll')
                ->will($this->returnValue($result));

        $pdoMock = $this->getMockBuilder('\Centralino\Database\PDO\_files\PDOMock')
                        ->setMethods(array('execute', 'prepare'))
                        ->getMock();

        $pdoMock->expects($this->any())
                ->method('execute')
                ->will($this->returnValue(true));

        $pdoMock->expects($this->any())
                ->method('prepare')
                ->will($this->returnValue($stmMock));

        $manager = new \Centralino\Database\PDO\Manager($pdoMock);

        return $manager;
    }
}
