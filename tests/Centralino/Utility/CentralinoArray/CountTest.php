<?php
namespace CentralinoArray;

use Centralino\Utility;

class CountTest extends \PHPUnit_Framework_TestCase
{
    public function testCount()
    {
        $array = new Utility\CentralinoArray(array(1, 2, 3));
        $this->assertEquals(3, $array->count());
    }

    public function testCount_Unset_Count()
    {
        $array = new Utility\CentralinoArray(array(1, 2, 3));
        unset($array[1]);
        $this->assertEquals(2, $array->count());
    }
}