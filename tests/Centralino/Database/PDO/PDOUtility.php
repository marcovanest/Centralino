<?php
namespace Centralino\Database\PDO;

use Tests;

class PDOUtility extends Tests\AbstractTestCase
{
    public function getPdoMock()
    {
        $stmtMock = $this->getMockBuilder('\PDOStatement')
                    ->getMock();

        $pdoMock = $this->getMockBuilder('\Centralino\Database\PDO\_files\PDOMock')
                    ->setMethods(array('prepare'))
                    ->getMock();

        $pdoMock->expects($this->any())
                    ->method('prepare')
                    ->will($this->returnValue($stmtMock));

        return $pdoMock;
    }
}
