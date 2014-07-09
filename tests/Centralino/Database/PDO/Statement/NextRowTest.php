<?php
namespace Statement;

class NextRowTest extends \PHPUnit_Framework_TestCase
{
    public function testNextRow()
    {
        $manager = $this->getPdoMock(array(1));

        $stm = $manager->select('SELECT * FROM LOG');

        $this->assertEquals(array(1), $stm->nextRow());
    }

    /**
     * @expectedException Centralino\Database\DatabaseException
     */
    public function testNextRow_With_Invalid_Cursor_Orientation_Throws()
    {
        $manager = $this->getPdoMock(array(1));

        $stm = $manager->select('SELECT * FROM LOG');
    }

    /**
     * @expectedException Centralino\Database\DatabaseException
     */
    public function testNextRow_With_Invalid_Cursor_Throws()
    {
        $manager = $this->getPdoMock(array(1));

        $stm = $manager->select('SELECT * FROM LOG', array(\PDO::ATTR_CURSOR => \PDO::CURSOR_FWDONLY));
    }

    private function getPdoMock($result)
    {
        $stmMock = $this->getMockBuilder('\PDOStatement')
                        ->setMethods(array('execute', 'fetch'))
                        ->getMock();

        $stmMock->expects($this->any())
                ->method('execute')
                ->will($this->returnValue(true));

        $stmMock->expects($this->any())
                ->method('fetch')
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
