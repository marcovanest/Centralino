<?php
namespace CentralinoFloat;

use Centralino\Utility;

class GetTest extends \PHPUnit_Framework_TestCase
{
    public function testGet_Positive()
    {
        $float = new Utility\CentralinoFloat(123.45);
        $this->assertEquals(123.45, $float->get());
    }

    public function testGet_Negative()
    {
        $float = new Utility\CentralinoFloat(-123.78);
        $this->assertEquals(-123.78, $float->get());
    }
}