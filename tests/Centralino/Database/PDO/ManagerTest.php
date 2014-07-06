<?php
namespace Centralino\Database\PDO;

class ManagerTest extends \PHPUnit_Framework_TestCase
{
   /**
    * @expectedException Centralino\Database\DatabaseException
    * @dataProvider excecuteWithWrongParameterProvider
    */
    public function testExecute_With_Wrong_Param_Count_Throws($statement, $params)
    {
        $PDOStatementstub   = $this->getMockBuilder('\PDOStatement')
                                    ->getMock();

        $PDOstub            = $this->getMockBuilder('Centralino\Database\PDO\_files\PDOMock')
                                    ->getMock();

        $PDOstub->expects($this->any())
                    ->method('prepare')
                    ->will($this->returnValue($PDOStatementstub));

        $manager = new Manager($PDOstub);

        $manager->select($statement, $params);
    }

    public function excecuteWithWrongParameterProvider()
    {
        return array(
          array('SELECT * FROM LOG WHERE id = ?', array()),
          array('SELECT * FROM LOG WHERE id = ?', array(1, 2)),
          array('SELECT * FROM LOG WHERE', array(1, 2)),
        );
    }
}
