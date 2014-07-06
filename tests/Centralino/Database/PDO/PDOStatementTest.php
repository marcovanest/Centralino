<?php
namespace Centralino\Database\PDO;

use Centralino;
use Tests;

require_once('PDOUtility.php');

class PDOStatementTest extends \PHPUnit_Framework_TestCase
{
    private $pdoUtility;

    public function setUp()
    {
        $this->pdoUtility = new PDOUtility();
    }

   /**
    * @expectedException Centralino\Database\DatabaseException
    */
    public function testSetFetchMode_With_Invalid_Mode_Throws()
    {
        $stmStub = $this->getMockBuilder('PDOStatement')
                    ->getMock();

        $statement = new PDOStatement($stmStub);
        $statement->setFetchMode(12);
    }

    public function testSetFetchMode_With_Valid_Mode()
    {
        $stmStub = $this->getMockBuilder('PDOStatement')
                    ->getMock();

        $statement = new PDOStatement($stmStub);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $this->assertEquals(\PDO::FETCH_OBJ, $statement->getFetchMode());
    }

   /**
    * @expectedException Centralino\Database\DatabaseException
    * @dataProvider excecuteWithWrongParameterProvider
    */
    public function testExecute_With_Wrong_Param_Count_Throws($statement, $params)
    {
        // $wrapper   = new Centralino\Database\PDO\Wrapper($this->pdoUtility->getPDOStub());
        // $statement  = $wrapper->prepare($statement);
        // $statement->execute($params);

        $stmStub = $this->getMockBuilder('\PDOStatement')
                        ->getMock();

        $PDOstub = $this->getMockBuilder('Centralino\Database\PDO\_files\PDOMock')
                    ->getMock();

        $PDOstub->expects($this->any())
                    ->method('prepare')
                    ->with($this->stringContains($statement))
                    ->will($this->returnValue($stmStub));

        $statement = new PDOStatement($stmStub);
        $statement->execute($params);
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