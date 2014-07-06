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
        $stmStub = $this->getMockBuilder('\PDOStatement')
                    ->getMock();

        $statement = new PDOStatement($stmStub);
        $statement->setFetchMode(12);
    }

    public function testSetFetchMode_With_Valid_Mode()
    {
        $stmStub = $this->getMockBuilder('\PDOStatement')
                    ->getMock();

        $statement = new PDOStatement($stmStub);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $this->assertEquals(\PDO::FETCH_OBJ, $statement->getFetchMode());
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