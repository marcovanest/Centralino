<?php
namespace CentralinoFloat;

use Centralino\Utility;

class SubTest extends \PHPUnit_Framework_TestCase
{
    public function testSub_Valid_Float_Return_True()
    {
        $float = new Utility\CentralinoFloat(123.45);
        $this->assertTrue($float->sub(122));
        $this->assertEquals(1.45, $float->get());
    }

    public function testSub_Negative_To_Positive()
    {
        $float = new Utility\CentralinoFloat(-10.10);
        $this->assertTrue($float->sub(30));
        $this->assertEquals(-40.10, $float->get());
    }

    public function testSub_Negative_To_Negative()
    {
        $float = new Utility\CentralinoFloat(-10.10);
        $this->assertTrue($float->sub(-40));
        $this->assertEquals(29.90, $float->get());
    }

    public function testSub_Invalid_Float_Return_False()
    {
        $float = new Utility\CentralinoFloat(123.5);
        $this->assertFalse($float->sub('231'));
        $this->assertEquals(123.50, $float->get());
    }
}