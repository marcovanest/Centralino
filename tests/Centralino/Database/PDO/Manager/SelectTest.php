<?php
namespace CentralinoManager;

use Centralino\Database\PDO;

class SelectTest extends \PHPUnit_Framework_TestCase
{
   /**
    * @expectedException Centralino\Database\DatabaseException
    * @dataProvider excecuteWithWrongParameterProvider
    */
    public function testSelect_With_Wrong_Param_Count_Throws($statement, $params)
    {
        $manager = new PDO\Manager($this->getPdoMock());

        $manager->select($statement, $params);
    }

   /**
    * @dataProvider excecuteWithValidParameterProvider
    */
    public function testSelect_With_Valid_Param_Count_Returns_Centralino_PDOStatement($statement, $params)
    {
        $manager = new PDO\Manager($this->getPdoMock());

        $result = $manager->select($statement, $params);

        $this->assertInstanceOf('Centralino\Database\PDO\PDOStatement', $result);
    }

    /**
     * @expectedException Centralino\Database\DatabaseException
     */
    public function testSelect_With_Empty_StatementString_Throws()
    {
        $manager = new PDO\Manager($this->getPdoMock());

        $manager->select("");
    }

    /**
     * @expectedException Centralino\Database\DatabaseException
     */
    public function testSelect_With_Invalid_Statement_Params_Throws()
    {
        $manager = new PDO\Manager($this->getPdoMock());

        $manager->select("SELECT * FROM LOG", "1");
    }


    public function excecuteWithWrongParameterProvider()
    {
        return array(
          array('SELECT * FROM LOG WHERE id = ?', array()),
          array('SELECT * FROM LOG WHERE id = ?', array(1, 2)),
          array('SELECT * FROM LOG WHERE', array(1, 2)),
        );
    }

    public function excecuteWithValidParameterProvider()
    {
        return array(
          array('SELECT * FROM LOG WHERE id = ?', array(1)),
          array('SELECT * FROM LOG WHERE id = ? AND id = ?', array(1, 2)),
          array('SELECT * FROM LOG WHERE', array()),
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
