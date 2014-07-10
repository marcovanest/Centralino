<?php
namespace Statement;

class SetFetchModeTest extends \PHPUnit_Framework_TestCase
{
    public function testSetFetchMode()
    {
        $manager = $this->getPdoMock(array(1));

        $stm = $manager->select('SELECT * FROM LOG');

        $stm->setFetchMode(\PDO::FETCH_OBJ);

        $this->assertEquals(\PDO::FETCH_OBJ, $stm->getFetchMode());
    }

    /**
     * @expectedException Centralino\Database\DatabaseException
     */
    public function testSetFetchMode_Wrong_Mode_Throws()
    {
        $manager = $this->getPdoMock(array(1));

        $stm = $manager->select('SELECT * FROM LOG');

        $stm->setFetchMode('invalid');
    }

    public function testSetFetchMode_With_Mode_And_Params()
    {
        $manager = $this->getPdoMock(array(1));

        $stm = $manager->select('SELECT * FROM LOG');

        $stm->setFetchMode(\PDO::FETCH_OBJ, array(121));
    }

    private function getPdoMock($result)
    {
        $stmtMock = $this->getMockBuilder('\PDOStatement')
                        ->setMethods(array('execute', 'fetch'))
                        ->getMock();

        $stmtMock->expects($this->any())
                ->method('execute')
                ->will($this->returnValue(true));

        $stmtMock->expects($this->any())
                ->method('fetch')
                ->will($this->returnValue($result));

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
