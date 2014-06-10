<?php
namespace Centralino\Database\PDO;

use Tests;

class PDOUtility extends Tests\AbstractTestCase
{
    public function getPDOStub($result = array())
    {
        $STMTstub = $this->getMockBuilder('PDOStatement')
                    ->getMock();

        $STMTstub->expects($this->any())
                    ->method('fetchAll')
                    ->will($this->returnValue($result));

        $PDOstub = $this->getMockBuilder('Centralino\Database\PDO\_files\PDOMock')
                    ->getMock();

        $PDOstub->expects($this->any())
                    ->method('prepare')
                    ->will($this->returnValue($STMTstub));

        $PDOstub->expects($this->any())
                    ->method('getAttribute')
                    ->with(\PDO::ATTR_ERRMODE)
                    ->will($this->returnValue(\PDO::ERRMODE_EXCEPTION));

        return $PDOstub;
    }
}