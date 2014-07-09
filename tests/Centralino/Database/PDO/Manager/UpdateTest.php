<?php
namespace CentralinoManager;

use Centralino\Database\PDO;

class UpdateTest extends \PHPUnit_Framework_TestCase
{
   /**
    * @expectedException Centralino\Database\DatabaseException
    * @dataProvider excecuteWithWrongParameterProvider
    */
    public function testUpdate_With_Wrong_Param_Count_Throws($statement, $params)
    {
        $manager = new PDO\Manager($this->getPdoMock());

        $manager->update($statement, $params);
    }

   /**
    * @dataProvider excecuteWithValidParameterProvider
    */
    public function testUpdate_With_Valid_Param_Count($statement, $params)
    {
        $manager = new PDO\Manager($this->getPdoMock());

        $result = $manager->update($statement, $params);

        $this->assertInstanceOf('Centralino\Database\PDO\PDOStatement', $result);
    }

    public function excecuteWithWrongParameterProvider()
    {
        return array(
          array('UPDATE LOG set message = ? WHERE id = ?', array()),
          array('UPDATE LOG set message = ? WHERE id = ?', array(1, 2, 3)),
          array('UPDATE LOG set message = ? WHERE', array(1, 2)),
        );
    }

    public function excecuteWithValidParameterProvider()
    {
        return array(
          array('UPDATE LOG set message = ? WHERE id = ?', array(1, 2)),
          array('UPDATE LOG set message = ?, id = ? WHERE id = ?', array(1, 2, 3)),
          array('UPDATE LOG set message = ?', array(11)),
        );
    }

    private function getPdoMock()
    {
        $stmMock = $this->getMockBuilder('\PDOStatement')
                        ->setMethods(array('execute'))
                        ->getMock();

        $stmMock->expects($this->any())
                ->method('execute')
                ->will($this->returnValue(true));

        $pdoMock = $this->getMockBuilder('Centralino\Database\PDO\_files\PDOMock')
                        ->setMethods(array('prepare'))
                        ->getMock();

        $pdoMock->expects($this->any())
                ->method('prepare')
                ->will($this->returnValue($stmMock));

        return $pdoMock;
    }
}
