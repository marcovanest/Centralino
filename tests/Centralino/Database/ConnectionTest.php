<?php
namespace Centralino\Database;

class ConnectionTest extends \PHPUnit_Framework_TestCase
{
    public function testCreatePdoConnection()
    {
        $connectionParams = array(
            'host'=>'localhost',
            'port'=>null,
            'dbname'=>'benny_test',
            'dbuser'=>'postgres',
            'dbpass'=>'tar',
            'options'=>array()
        );

        $pdo = Connection::createPDOConnection('pgsql', $connectionParams);

        $this->assertInstanceOf('Centralino\Database\PDO\Manager', $pdo);
    }

   /**
    * @expectedException Centralino\Database\DatabaseException
    * @expectedExceptionMessage The given driver is either invalid or not implemented
    */
    public function testCreatePdoConnection_With_Invalid_Driver_Name()
    {
        $connectionParams = array(
            'host'=>'localhost',
            'port'=>null,
            'dbname'=>'benny_test',
            'dbuser'=>'postgres',
            'dbpass'=>'tar',
            'options'=>array()
        );

        $pdo = Connection::createPDOConnection('dblib', $connectionParams);
    }

   /**
    * @expectedException Centralino\Database\DatabaseException
    * @expectedExceptionMessage Db connection failed
    */
    public function testCreatePdoConnection_With_Invalid_Credentials()
    {
        $connectionParams = array(
            'host'=>'localhost',
            'port'=>null,
            'dbname'=>'',
            'dbuser'=>'',
            'dbpass'=>'',
            'options'=>array()
        );

        $pdo = Connection::createPDOConnection('pgsql', $connectionParams);
    }
}