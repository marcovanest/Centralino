<?php
namespace Statement;

class SetFetchModeTest extends \PHPUnit_Framework_TestCase
{
    public function testSetFetchMode()
    {
        $manager = $this->getDbStub(array(1));

        $stm = $manager->select('SELECT * FROM LOG');

        $stm->setFetchMode(\PDO::FETCH_OBJ);

        $this->assertEquals(\PDO::FETCH_OBJ, $stm->getFetchMode());
    }

    /**
     * @expectedException Centralino\Database\DatabaseException
     */
    public function testSetFetchMode_Wrong_Mode_Throws()
    {
        $manager = $this->getDbStub(array(1));

        $stm = $manager->select('SELECT * FROM LOG');

        $stm->setFetchMode('invalid');
    }

    public function testSetFetchMode_With_Mode_And_Params()
    {
        $manager = $this->getDbStub(array(1));

        $stm = $manager->select('SELECT * FROM LOG');

        $stm->setFetchMode(\PDO::FETCH_OBJ, array(121));
    }

    private function getDbStub($result)
    {
        $STMTstub = $this->getMockBuilder('\PDOStatement')
                        ->setMethods(array('fetch'))
                        ->getMock();

        $STMTstub->expects($this->any())
                ->method('fetch')
                ->will($this->returnValue($result));

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
