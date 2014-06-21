<?php
namespace CentralinoArray;

use Centralino\Utility;

class OffsetTest extends \PHPUnit_Framework_TestCase
{
    public function testOffsetSet()
    {
        $array = new Utility\CentralinoArray(array(1, 2, 3));

        $array[0] = 11;

        $this->assertEquals(array(11,2,3), $array->get());
    }

    public function testOffsetGet_Indexed()
    {
        $array = new Utility\CentralinoArray(array(1, 2, 3));
        $this->assertEquals(3, $array[2]);
    }

    public function testOffsetGet_Associative()
    {
        $array = new Utility\CentralinoArray(array('one' => 1, 'two' => 2, 'three' => 3));
        $this->assertEquals(3, $array['three']);
    }

    public function testOffsetExists_True_Indexed()
    {
        $array = new Utility\CentralinoArray(array(1, 2, 3));
        $this->assertTrue(isset($array[1]));
    }

    public function testOffsetExists_True_Associative()
    {
        $array = new Utility\CentralinoArray(array('one' => 1, 'two' => 2, 'three' => 3));
        $this->assertTrue(isset($array['two']));
    }

    public function testOffsetExists_False_Indexed()
    {
        $array = new Utility\CentralinoArray(array(1, 2, 3));
        $this->assertFalse(isset($array[4]));
    }

    public function testOffsetExists_False_Associative()
    {
        $array = new Utility\CentralinoArray(array('one' => 1, 'two' => 2, 'three' => 3));
        $this->assertFalse(isset($array['four']));
    }

    public function testOffsetUnset_Indexed()
    {
        $array = new Utility\CentralinoArray(array(1, 2, 3));
        unset($array[1]);
        $this->assertEquals(array(0 => 1, 2 => 3), $array->get());
    }

    public function testOffsetUnset_Associative()
    {
        $array = new Utility\CentralinoArray(array('one' => 1, 'two' => 2, 'three' => 3));
        unset($array['two']);
        $this->assertEquals(array('one' => 1, 'three' => 3), $array->get());
    }
}