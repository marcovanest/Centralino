<?php
namespace Centralino\Database\PDO;

use Centralino;
use Tests;

class WrapperUpdateTest extends Tests\AbstractDatabaseTestCase
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

   /**
    * @expectedException Centralino\Database\DatabaseException
    * @dataProvider updateWithWrongParameterProvider
    */
    public function testUpdate_With_Wrong_Param_Count_Throws($updateStatement, $aParams)
    {
        $instance   = $this->createDBConnection();
        $statement = $instance->update($updateStatement, $aParams);
    }

    public function updateWithWrongParameterProvider()
    {
        return array(
          array('UPDATE set level = ? WHERE id = ?', array()),
          array('UPDATE set level = ? WHERE id = ?', array('non critical', 1)),
          array('UPDATE set level = ? WHERE id = ? AND message = ?', array('non critical', 1)),
        );
    }

    public function testUpdate_With_Valid_Statement_And_Params()
    {
        $instance   = $this->createDBConnection();
        $statement  = $instance->update('UPDATE LOG set level = ? WHERE id = ?', array('warning', 1));

        $this->assertEquals(1, $statement->getNumberOfAffectedRows());

        $statement = $instance->select('SELECT * FROM LOG WHERE id = ?', array(1));

        $rowObject = $statement->nextRow();

        $this->assertTrue(is_object($rowObject));
        $this->assertEquals('warning', $rowObject->level);
        $this->assertEquals('Database connectionstring invalid', $rowObject->message);
    }
}