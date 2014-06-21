<?php
namespace CentralinoArray;

use Centralino\Utility;

class SerializeTest extends \PHPUnit_Framework_TestCase
{
    public function testSerialize()
    {
        $array = new Utility\CentralinoArray(array(1, 2, 3));
        $this->assertEquals('a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}', $array->serialize());
    }

    public function testUnserialize()
    {
        $array = new Utility\CentralinoArray(array());
        $array->unserialize('a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}');

        $this->assertEquals(array(1, 2, 3), $array->get());
    }
}