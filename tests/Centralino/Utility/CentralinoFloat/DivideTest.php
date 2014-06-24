<?php
namespace CentralinoFloat;

use Centralino\Utility;

class DivTest extends \PHPUnit_Framework_TestCase
{
    public function testDivide_Valid_float_Return_True()
    {
        $float = new Utility\CentralinoFloat(123.12);
        $this->assertTrue($float->div(2));
        $this->assertEquals(61.56, $float->get());
    }

    public function testDiv_With_Fraction_Positive()
    {
        $float = new Utility\CentralinoFloat(100.44);
        $this->assertTrue($float->div(3));
        $this->assertEquals(33.48, $float->get());
    }

    public function testDiv_Positive_With_Negative_Integer()
    {
        $float = new Utility\CentralinoFloat(-100.12);
        $this->assertTrue($float->div(3));
        $this->assertEquals(-33.37, $float->get());
    }

    public function testDiv_Positive_With_Negative_Float()
    {
        $float = new Utility\CentralinoFloat(-100.12);
        $this->assertTrue($float->div(4.45));
        $this->assertEquals(-22.50, $float->get());
    }

    public function testDiv_Negative_With_Negative_Integer()
    {
        $float = new Utility\CentralinoFloat(-100.55);
        $this->assertTrue($float->div(-2));
        $this->assertEquals(50.28, $float->get());
    }

    public function testDiv_Negative_With_Negative_Float()
    {
        $float = new Utility\CentralinoFloat(-100.55);
        $this->assertTrue($float->div(-6.212));
        $this->assertEquals(16.19, $float->get());
    }

    public function testDiv_Invalid_float_Return_False()
    {
        $float = new Utility\CentralinoFloat(123.77);
        $this->assertFalse($float->div('231'));
        $this->assertEquals(123.77, $float->get());
    }
}