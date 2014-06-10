<?php
namespace Centralino\Database\PDO;

use Centralino;
use Tests;

class WrapperDeleteTest extends Tests\AbstractDatabaseTestCase
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
    * @dataProvider deleteWithWrongParameterProvider
    */
    public function testDelete_With_Wrong_Param_Count_Throws($updateStatement, $aParams)
    {
        $instance   = $this->createDBConnection();
        $statement = $instance->delete($updateStatement, $aParams);
    }

    public function deleteWithWrongParameterProvider()
    {
        return array(
          array('DELETE FROM level WHERE id = ?', array()),
          array('DELETE FROM level WHERE id = ?', array('non critical', 1)),
          array('DELETE FROM level WHERE id = ? AND message = ?', array('non critical', 1)),
        );
    }

    public function testDelete_With_Valid_Statement_And_Params()
    {
        $instance   = $this->createDBConnection();
        $statement  = $instance->delete('DELETE FROM LOG WHERE id = ?', array(1));

        $this->assertEquals(1, $statement->getNumberOfAffectedRows());

        $statement = $instance->select('SELECT * FROM LOG WHERE id = ?', array(1));

        $rowObject = $statement->nextRow();

        $this->assertFalse($rowObject);
    }
}