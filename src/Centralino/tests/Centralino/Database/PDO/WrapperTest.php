<?php
namespace Centralino\Database\PDO;

use Centralino;
use org\bovigo\vfs;

require_once('PDOUtility.php');

class WrapperTest extends \PHPUnit_Framework_TestCase
{
    private $pdoUtility;

    public function setUp()
    {
        $this->pdoUtility = new PDOUtility();
    }

   /**
    * @expectedException PHPUnit_Framework_Error
    */
    public function testCreateWrapperInstance_With_Invalid_PDOInstance_Throws()
    {
        $wrapper    = new Centralino\Database\PDO\Wrapper(array());
    }

   /**
    * @expectedException Centralino\Database\DatabaseException
    */
    public function testCreateWrapperInstance_With_Invalid_PDOInstance_ErrorMode_Throws()
    {
        $stub = $this->getMockBuilder('Centralino\Database\PDO\_files\PDOMock')
                    ->getMock();

        $stub->expects($this->any())
                    ->method('getAttribute')
                    ->with(\PDO::ATTR_ERRMODE)
                    ->will($this->returnValue(\PDO::ERRMODE_SILENT));

        $wrapper = new Centralino\Database\PDO\Wrapper($stub);
    }

    public function testGetPDOHandle_Returns_Pdo_Instance()
    {
        $wrapper = new Centralino\Database\PDO\Wrapper($this->pdoUtility->getPDOStub());

        $this->assertInstanceOf('\PDO', $wrapper->getPdoInstance());
    }

    public function testPrepare_Returns_Statement_Instance()
    {
        $wrapper   = new Centralino\Database\PDO\Wrapper($this->pdoUtility->getPDOStub());
        $statement = $wrapper->prepare('SELECT * FROM LOG');

        $this->assertInstanceOf('Centralino\Database\PDO\Statement', $statement);
    }

   /**
    * @expectedException Centralino\Database\DatabaseException
    */
    public function testPrepare_Invalid_Argument_Throws()
    {
        $wrapper   = new Centralino\Database\PDO\Wrapper($this->pdoUtility->getPDOStub());
        $statement = $wrapper->prepare(array());
    }
}