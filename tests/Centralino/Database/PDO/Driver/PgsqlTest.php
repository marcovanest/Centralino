<?php
namespace Centralino\Database\PDO\Driver;

class PgsqlTest extends \PHPUnit_Framework_TestCase
{
    public function testIs_Initializable()
    {
        $pgsql = new Pgsql('localhost', 1433, 'postgres', 'postgres', 'tar', array());
        $this->assertInstanceOf('Centralino\Database\PDO\Driver\DriverInterface', $pgsql);
    }

    public function testGet_DBUser()
    {
        $pgsql = new Pgsql('localhost', 1433, 'postgres', 'postgres', 'tar', array());
        $this->assertEquals('postgres', $pgsql->getDBUser());
    }

    public function testGet_DBPass()
    {
        $pgsql = new Pgsql('localhost', 1433, 'postgres', 'postgres', 'tar', array());
        $this->assertEquals('tar', $pgsql->getDBPass());
    }

    public function testGet_DBOptions()
    {
        $pgsql = new Pgsql('localhost', 1433, 'postgres', 'postgres', 'tar', array(1, 2, 3));
        $this->assertEquals(array(1, 2, 3), $pgsql->getDBOptions());
    }

    public function testGet_Name()
    {
        $pgsql = new Pgsql('localhost', 1433, 'postgres', 'postgres', 'tar', array());
        $this->assertEquals('pgsql', $pgsql->getName());
    }

    public function testGet_Dsn()
    {
        $pgsql = new Pgsql('localhost', 1433, 'postgres', 'postgres', 'tar', array());
        $this->assertEquals('pgsql:host=localhost;port=1433;dbname=postgres;', $pgsql->getDsn());
    }

    public function testGet_Charset()
    {
        $pgsql = new Pgsql('localhost', 1433, 'postgres', 'postgres', 'tar', array());
        $this->assertEquals('utf8', $pgsql->getCharset());
    }
}