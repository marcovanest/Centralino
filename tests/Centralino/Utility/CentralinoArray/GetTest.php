<?php
namespace CentralinoArray;

use Centralino\Utility;

class GetTest extends \PHPUnit_Framework_TestCase
{
    public function testGet()
    {
        $array = new Utility\CentralinoArray(array(1, 2, 3));
        $this->assertEquals(array(1, 2, 3), $array->get());
    }
}