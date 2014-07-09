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
        $manager = $this->getDbStub(array(1));

        $stm = $manager->select('SELECT * FROM LOG');
        $stm->execute();
    }

    private function getDbStub($result)
    {
        $STMTstub = $this->getMockBuilder('\PDOStatement')
                        ->setMethods(array('execute', 'fetch'))
                        ->getMock();

        $STMTstub->expects($this->any())
                ->method('execute')
                ->will($this->returnCallback(function () {
                  throw new \PDOException();
                }));

        $STMTstub->expects($this->any())
                ->method('fetch')
                ->will($this->returnValue($result));

        $PDOstub = $this->getMockBuilder('\Centralino\Database\PDO\_files\PDOMock')
                            ->setMethods(array('prepare'))
                            ->getMock();

        $PDOstub->expects($this->any())
                ->method('prepare')
                ->will($this->returnValue($STMTstub));

        $manager = new \Centralino\Database\PDO\Manager($PDOstub);

        return $manager;
    }
}
