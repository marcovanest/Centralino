<?php
namespace Statement;

class NextRowTest extends \PHPUnit_Framework_TestCase
{
    public function testNextRow()
    {
        $manager = $this->getDbStub(array(1));

        $stm = $manager->select('SELECT * FROM LOG');

        $this->assertEquals(array(1), $stm->nextRow('3232423'));
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
