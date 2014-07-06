<?php
namespace CentralinoArray;

use Centralino\Utility;

class SeekTest extends \PHPUnit_Framework_TestCase
{
    public function testSeek_Indexed()
    {
        $array = Utility\CentralinoArray::create(array(1, 2, 3));
        $array->seek(2);
        $this->assertEquals(3, $array->current());
    }

    public function testSeek_Associative()
    {
        $array = Utility\CentralinoArray::create(array('one' => 1, 'two' => 2, 'three' => 3));
        $array->seek(2);
        $this->assertEquals(3, $array->current());
    }

   /**
    * @expectedException OutOfBoundsException
    */
    public function testSeek_Out_Of_Bounds()
    {
        $array = Utility\CentralinoArray::create(array(1, 2, 3));
        $array->seek(4);
    }
}