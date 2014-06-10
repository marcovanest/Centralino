<?php
namespace Centralino\Database\PDO;

use Centralino;
use Tests;

class WrapperSelectTest extends Tests\AbstractDatabaseTestCase
{
    /**
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    public function getConnection()
    {
        $wrapper = $this->createDBConnection();
        return $this->createDefaultDBConnection($wrapper->getPdoInstance(), ':pqsql');
    }

    /**
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    public function getDataSet()
    {
        return $this->createXMLDataSet(dirname(__FILE__).'/_files/dataset.xml');
    }


    public function testSelect_Default_Params()
    {
        $instance   = $this->createDBConnection();
        $statement = $instance->select('SELECT * FROM LOG');

        $this->assertInstanceOf('Centralino\Database\PDO\Statement', $statement);
    }

   /**
    * @expectedException Centralino\Database\DatabaseException
    */
    public function testSelect_With_Invalid_Sql_Statement_Must_Throw()
    {
        $instance   = $this->createDBConnection();
        $statement = $instance->select('SELECT * FROM sdfdsfsdLOG');
    }

   /**
    * @expectedException Centralino\Database\DatabaseException
    */
    public function testSelect_With_Invalid_Fetch_Mode_Must_Throw()
    {
        $instance   = $this->createDBConnection();
        $statement = $instance->select('SELECT * FROM LOG', array(), 'DONT EXIST');
    }

   /**
    * @expectedException Centralino\Database\DatabaseException
    */
    public function testSelect_With_Wrong_ParamHolder_Count_Throws()
    {
        $instance   = $this->createDBConnection();
        $statement = $instance->select('SELECT * FROM LOG WHERE level = ?', array(1, 2, 3));
    }

   /**
    * @expectedException Centralino\Database\DatabaseException
    */
    public function testSelect_With_Wrong_Param_Count_Throws()
    {
        $instance   = $this->createDBConnection();
        $statement = $instance->select('SELECT * FROM LOG WHERE id = ? AND level = ?', array(1));
    }

   /**
    * @expectedException Centralino\Database\DatabaseException
    */
    public function testSelect_With_No_Sql_Statement_Must_Throw()
    {
        $instance   = $this->createDBConnection();
        $statement = $instance->select();
    }

    public function testSelect_NextRow_With_FetchAssoc()
    {
        $instance   = $this->createDBConnection();
        $statement  = $instance->select('SELECT * FROM LOG', array(), \PDO::FETCH_ASSOC);

        $rowArray   = $statement->nextRow();
        $this->assertTrue(is_array($rowArray));
        $this->assertEquals('critical', $rowArray['level']);
        $this->assertEquals('Database connectionstring invalid', $rowArray['message']);
    }

    public function testSelect_NextRow_With_FetchBoth()
    {
        $instance   = $this->createDBConnection();
        $statement  = $instance->select('SELECT * FROM LOG', array(), \PDO::FETCH_BOTH);

        $rowArray   = $statement->nextRow();
        $this->assertTrue(is_array($rowArray));
        $this->assertEquals('critical', $rowArray['level']);
        $this->assertEquals('critical', $rowArray[1]);

        $this->assertEquals('Database connectionstring invalid', $rowArray['message']);
        $this->assertEquals('Database connectionstring invalid', $rowArray[2]);
    }

    public function testSelect_With_FetchBound()
    {
        $instance   = $this->createDBConnection();
        $statement  = $instance->select(
            'SELECT * FROM LOG',
            array(),
            \PDO::FETCH_BOUND
            );

        $statement->bindColumn(1, $id);
        $statement->bindColumn(2, $level);
        $statement->bindColumn(3, $message);

        while ($row = $statement->nextRow()) {
            $this->assertTrue($row);
            $this->assertEquals(1, $id);
            $this->assertEquals('critical', $level);
            $this->assertEquals('Database connectionstring invalid', $message);
        }
    }

    public function testAllRows_With_FetchClass()
    {
        $instance   = $this->createDBConnection();
        $rows       = $instance->select(
            'SELECT * FROM LOG',
            array(),
            \PDO::FETCH_CLASS,
            'Centralino\Database\PDO\_files\DummyUser'
            );

        foreach ($rows as $row) {
            $this->assertInstanceOf('Centralino\Database\PDO\_files\DummyUser', $row);
            $this->assertEquals(1, $row->id);
            $this->assertEquals('critical', $row->level);
            $this->assertEquals('Database connectionstring invalid', $row->message);
        }
    }

    public function testSelect_With_FetchInto()
    {
        $instance       = $this->createDBConnection();
        $statement      = $instance->select(
            'SELECT * FROM LOG',
            array(),
            \PDO::FETCH_INTO,
            new Centralino\Database\PDO\_files\DummyUser()
        );

        $dummyUser   = $statement->nextRow();

        $this->assertInstanceOf('Centralino\Database\PDO\_files\DummyUser', $dummyUser);
        $this->assertEquals(1, $dummyUser->id);
        $this->assertEquals('critical', $dummyUser->level);
        $this->assertEquals('Database connectionstring invalid', $dummyUser->message);
    }

    public function testSelect_With_FetchLazy()
    {
        $instance       = $this->createDBConnection();
        $statement   = $instance->select('SELECT * FROM LOG', array(), \PDO::FETCH_LAZY);

        $pdoRowObject   = $statement->nextRow();

        $this->assertInstanceOf('\PDORow', $pdoRowObject);
        $this->assertEquals(1, $pdoRowObject->id);
        $this->assertEquals(1, $pdoRowObject[0]);
        $this->assertEquals('critical', $pdoRowObject->level);
        $this->assertEquals('critical', $pdoRowObject[1]);
        $this->assertEquals('Database connectionstring invalid', $pdoRowObject->message);
        $this->assertEquals('Database connectionstring invalid', $pdoRowObject[2]);
    }

    public function testSelect_With_FetchNamed()
    {
        $instance   = $this->createDBConnection();
        $statement   = $instance->select(
            'SELECT id, level, message, level as message FROM LOG',
            array(),
            \PDO::FETCH_NAMED
        );

        $rowArray   = $statement->nextRow();

        $this->assertTrue(is_array($rowArray));
        $this->assertEquals(1, $rowArray['id']);
        $this->assertEquals('critical', $rowArray['level']);
        $this->assertCount(2, $rowArray['message']);
        $this->assertEquals('Database connectionstring invalid', $rowArray['message'][0]);
        $this->assertEquals('critical', $rowArray['message'][1]);
    }

    public function testSelect_With_FetchNum()
    {
        $instance   = $this->createDBConnection();
        $statement   = $instance->select('SELECT * FROM LOG', array(), \PDO::FETCH_NUM);

        $rowArray   = $statement->nextRow();

        $this->assertTrue(is_array($rowArray));
        $this->assertEquals(1, $rowArray[0]);
        $this->assertEquals('critical', $rowArray[1]);
        $this->assertEquals('Database connectionstring invalid', $rowArray[2]);
    }

    public function testSelect_With_FetchObj()
    {
        $instance   = $this->createDBConnection();
        $statement  = $instance->select('SELECT * FROM LOG', array(), \PDO::FETCH_OBJ);

        $rowObject   = $statement->nextRow();

        $this->assertTrue(is_object($rowObject));
        $this->assertEquals('critical', $rowObject->level);
        $this->assertEquals('Database connectionstring invalid', $rowObject->message);
    }
}