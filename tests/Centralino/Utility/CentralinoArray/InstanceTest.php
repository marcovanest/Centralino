<?php
namespace CentralinoArray;

use Centralino\Utility;

class InstanceTest extends \PHPUnit_Framework_TestCase
{
   /**
    * @expectedException PHPUnit_Framework_Error
    */
    public function testCentralinoArray_Invalid_Array_Throws()
    {
        $array = new Utility\CentralinoArray("test");
    }
}