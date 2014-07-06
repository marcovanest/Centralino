<?php
namespace CentralinoArray;

use Centralino\Utility;

class KeysTest extends \PHPUnit_Framework_TestCase
{
    public function testKeys_Indexed()
    {
        $array = Utility\CentralinoArray::create(array(1, 2, 3));
        $this->assertEquals(array(0, 1, 2), $array->keys());
    }

    public function testKeys_Associative()
    {
        $array = Utility\CentralinoArray::create(array('one' => 1, 'two' => 2, 'three' => 3));
        $this->assertEquals(array('one', 'two', 'three'), $array->keys());
    }
}