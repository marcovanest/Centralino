<?php
namespace CentralinoArray;

use Centralino\Utility;

class CurrentTest extends \PHPUnit_Framework_TestCase
{
    public function testCurrent_Indexed()
    {
        $array = Utility\CentralinoArray::create(array(1, 2, 3));
        $this->assertEquals(1, $array->current());
    }

    public function testCurent_Associative()
    {
        $array = Utility\CentralinoArray::create(array('one' => 1, 'two' => 2, 'three' => 3));
        $this->assertEquals(1, $array->current());
    }

    public function testCurent_Next()
    {
        $array = Utility\CentralinoArray::create(array(1, 2, 3));
        $array->next();
        $array->next();

        $this->assertEquals(3, $array->current());
    }

    public function testCurent_Prev()
    {
        $array = Utility\CentralinoArray::create(array(1, 2, 3));
        $array->next();
        $array->next();
        $array->prev();

        $this->assertEquals(2, $array->current());
    }

    public function testCurent_Seek()
    {
        $array = Utility\CentralinoArray::create(array(1, 2, 3));
        $array->seek(2);

        $this->assertEquals(3, $array->current());
    }

    public function testCurent_Rewind()
    {
        $array = Utility\CentralinoArray::create(array(1, 2, 3));
        $array->seek(2);
        $array->rewind();

        $this->assertEquals(1, $array->current());
    }
}