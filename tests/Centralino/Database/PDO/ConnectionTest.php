<?php
namespace Centralino\Database\PDO;

class PDOConnectionTest extends \PHPUnit_Framework_TestCase
{
    public function testIs_Initializable()
    {
        $driver     = new Driver\Pgsql('localhost', null, 'benny_test', 'postgres', 'tar');
        $connection = new PDOConnection($driver);

        $this->assertInstanceOf('Centralino\Database\PDO\PDOConnection', $connection);
    }

    public function testCreate()
    {
        $driver     = new Driver\Pgsql('localhost', null, 'benny_test', 'postgres', 'tar');
        $connection = new PDOConnection($driver);

        $this->assertInstanceOf('\PDO', $connection->create());
    }
}