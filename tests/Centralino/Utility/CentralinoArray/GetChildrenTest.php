<?php
namespace CentralinoArray;

use Centralino\Utility;

class GetChildrenTest extends \PHPUnit_Framework_TestCase
{
    public function testGetChildren_Return_CentralinoArray_Instance()
    {
        $array = Utility\CentralinoArray::create(array(1, 2, array(3,4,5)));
        $array->seek(2);
        $child = $array->getChildren();

        $this->assertInstanceOf('Centralino\Utility\CentralinoArray', $child);
    }

    public function testGetChildren_No_Children_Return_False()
    {
        $array = Utility\CentralinoArray::create(array(1, 2, array(3,4,5)));
        $array->seek(1);
        $this->assertFalse($array->getChildren());
    }
}