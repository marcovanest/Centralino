<?php
namespace Centralino\Database\PDO;

use Centralino;
use Tests;

require_once('PDOUtility.php');

class StatementTest extends \PHPUnit_Framework_TestCase
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
        $wrapper   = new Centralino\Database\PDO\Wrapper($this->pdoUtility->getPDOStub());
        $statement  = $wrapper->prepare('SELECT * FROM LOG');
        $statement->setFetchMode(12);
    }

    public function testSetFetchMode_With_Valid_Mode()
    {
        $wrapper   = new Centralino\Database\PDO\Wrapper($this->pdoUtility->getPDOStub());
        $statement  = $wrapper->prepare('SELECT * FROM LOG');
        $statement->setFetchMode(\PDO::FETCH_OBJ);

        $this->assertEquals(\PDO::FETCH_OBJ, $statement->getFetchMode());
    }

   /**
    * @expectedException Centralino\Database\DatabaseException
    * @dataProvider excecuteWithWrongParameterProvider
    */
    public function testExecute_With_Wrong_Param_Count_Throws($statement, $params)
    {
        $wrapper   = new Centralino\Database\PDO\Wrapper($this->pdoUtility->getPDOStub());
        $statement  = $wrapper->prepare($statement);
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