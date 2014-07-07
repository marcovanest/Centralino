<?php
namespace CentralinoArray;

use Centralino\Utility;

class ValidTest extends \PHPUnit_Framework_TestCase
{
    public function testValid()
    {
        $array = new Utility\CentralinoArray(array(1, 2, 3));
        $this->assertTrue($array->valid());
    }

    public function testValid_Next_True()
    {
        $array = new Utility\CentralinoArray(array(1, 2, 3));
        $array->next();
        $array->next();
        $this->assertTrue($array->valid());
    }

    public function testValid_Next_False()
    {
        $array = new Utility\CentralinoArray(array(1, 2, 3));
        $array->next();
        $array->next();
        $array->next();
        $this->assertFalse($array->valid());
    }

    public function testValid_Prev_False()
    {
        $array = new Utility\CentralinoArray(array(1, 2, 3));
        $array->prev();
        $this->assertFalse($array->valid());
    }

    public function testValid_Next_Rewind_True()
    {
        $array = new Utility\CentralinoArray(array(1, 2, 3));
        $array->next();
        $array->next();
        $array->next();
        $array->rewind();
        $this->assertTrue($array->valid());
    }

    public function testValid_Prev_Rewind_True()
    {
        $array = new Utility\CentralinoArray(array(1, 2, 3));
        $array->prev();
        $array->prev();
        $array->rewind();
        $this->assertTrue($array->valid());
    }
}
