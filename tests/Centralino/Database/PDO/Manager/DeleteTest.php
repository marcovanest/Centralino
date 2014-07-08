<?php
namespace CentralinoManager;

use Centralino\Database\PDO;

class DeleteTest extends \PHPUnit_Framework_TestCase
{
   /**
    * @expectedException Centralino\Database\DatabaseException
    * @dataProvider excecuteWithWrongParameterProvider
    */
    public function testDelete_With_Wrong_Param_Count_Throws($statement, $params)
    {
        $manager = new PDO\Manager($this->getPdoMock());
        $manager->update($statement, $params);
    }

   /**
    * @dataProvider excecuteWithValidParameterProvider
    */
    public function testDelete_With_Valid_Param_Count($statement, $params)
    {
        $manager = new PDO\Manager($this->getPdoMock());

        $result = $manager->delete($statement, $params);

        $this->assertInstanceOf('Centralino\Database\PDO\PDOStatement', $result);
    }

    public function excecuteWithWrongParameterProvider()
    {
        return array(
          array('DELETE FROM LOG WHERE id = ?', array()),
          array('DELETE FROM LOG WHERE id = ?', array(1, 2, 3)),
          array('DELETE FROM LOG', array(1, 2)),
        );
    }

    public function excecuteWithValidParameterProvider()
    {
        return array(
          array('DELETE FROM LOG WHERE id = ?', array(1)),
          array('DELETE FROM LOG WHERE id = ? AND id = ?', array(1, 2)),
          array('DELETE FROM LOG', array()),
        );
    }

    private function getPdoMock()
    {
        $pdoStatementstub = $this->getMockBuilder('\PDOStatement')
                                    ->getMock();

        $pdoStatementstub->expects($this->any())
            ->method('execute')
            ->will($this->returnValue(true));

        $pdoStub = $this->getMockBuilder('Centralino\Database\PDO\_files\PDOMock')
                                    ->getMock();

        $pdoStub->expects($this->any())
                    ->method('prepare')
                    ->will($this->returnValue($pdoStatementstub));

        return $pdoStub;
    }
}
