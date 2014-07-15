<?php
namespace Centralino\Database\PDO;

class PDOConnectionTest extends \PHPUnit_Framework_TestCase
{
    public function testIs_Initializable()
    {
        $driverStub = $this->getMockBuilder('Centralino\Database\PDO\Driver\Pgsql')
                        ->getMock();

        $connection = new PDOConnection($driverStub);

        $this->assertInstanceOf('Centralino\Database\PDO\PDOConnection', $connection);
    }

    public function testCreate()
    {
        $driverStub = $this->getMockBuilder('Centralino\Database\PDO\Driver\Pgsql')
                        ->getMock();

        $connection = new PDOConnection($driverStub);

        $this->assertInstanceOf('\PDO', $connection->create());
    }
}
