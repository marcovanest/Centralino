<?php
namespace Centralino\Database\PDO;

class ConnectionTest extends \PHPUnit_Framework_TestCase
{
    public function testIsInitializable()
    {
        $driver     = new Driver\Pgsql('localhost', null, 'benny_test', 'postgres', 'tar');
        $connection = new Connection($driver);

        $this->assertInstanceOf('Centralino\Database\PDO\Connection', $connection);

        $connection->create();

    }

    public function testCreate()
    {
        $driver     = new Driver\Pgsql('localhost', null, 'benny_test', 'postgres', 'tar');
        $connection = new Connection($driver);
        $connection->create();

        $this->assertInstanceOf('\PDO', $connection->getPDOInstance());
    }
}