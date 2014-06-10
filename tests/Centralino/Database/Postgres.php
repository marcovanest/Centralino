<?php
namespace Centralino\Database;

use Tests;
use Centralino;

class PostgresTest extends Tests\TestCase
{
    /**
    * @expectedException Centralino\Database\DatabaseException
    * @dataProvider InvalidDatabaseCredentialProvider
    */
    public function testConnectWithInvalidCredentialsThrowsException($db, $host, $user, $pass)
    {
        $db     = new Centralino\Database\PDO\Postgres($db, $host, $user, $pass);
        $db->setLogger(new Centralino\Core\Logger\DefaultLogger());

        $db->connect();
        $db->disconnect();
    }

    /**
    * @dataProvider ValidDatabaseCredentialProvider
    */
    public function testConnectWithValidCredentialsReturnClassInstance($db, $host, $user, $pass)
    {
        $db = new Centralino\Database\PDO\Postgres($db, $host, $user, $pass);
        $db->setLogger(new Centralino\Core\Logger\DefaultLogger());

        $this->assertInstanceOf('Centralino\Database\PDO\Postgres',  $db->connect());
        $db->disconnect();
    }

    /**
    * @dataProvider ValidDatabaseCredentialProvider
    */
    public function testDisconnectSetsPDOInstanceToNull($db, $host, $user, $pass)
    {
        $db = new Centralino\Database\PDO\Postgres($db, $host, $user, $pass);
        $db->setLogger(new Centralino\Core\Logger\DefaultLogger());

        $db->connect();

        $PDOInstance = $db->getHandle();

        $this->assertInstanceOf('\PDO', $PDOInstance);

        $db->disconnect();

        $PDOInstance = $db->getHandle();

        $this->assertNull($PDOInstance);
    }

    public function ValidDatabaseCredentialProvider()
    {
        return array(
            array('benny', 'benny', 'postgres', 'tar'),
            );
    }

    public function InvalidDatabaseCredentialProvider()
    {
        return array(
            array('', '', '', ''),
            array('benny', '', '', ''),
            array('benny', 'localhost', '', ''),
            array('benny', 'benny', 'postgres', ''),
            array('benny', 'benny', 'postgres', 'tarrr'),
            );
    }
}