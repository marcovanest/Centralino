<?php
namespace CentralinoArray;

use Centralino\Utility;

class HasChildrenTest extends \PHPUnit_Framework_TestCase
{
    public function testHasChildren_True()
    {
        $array = new Utility\CentralinoArray(array(1, 2, array(3,4,5)));
        $array->seek(2);
        $this->assertTrue($array->hasChildren());
    }

    public function testHasChildren_False()
    {
        $array = new Utility\CentralinoArray(array(1, 2, array(3,4,5)));
        $array->seek(1);
        $this->assertFalse($array->hasChildren());
    }
}