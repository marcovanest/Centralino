<?php
namespace CentralinoInteger;

use Centralino\Utility;

class DivTest extends \PHPUnit_Framework_TestCase
{
    public function testDiv_Valid_Integer_Return_True()
    {
        $integer = new Utility\CentralinoInteger(123);
        $this->assertTrue($integer->div(123));
        $this->assertEquals(1, $integer->get());
    }

    public function testDiv_With_Fraction_Positive()
    {
        $integer = new Utility\CentralinoInteger(100);
        $this->assertTrue($integer->div(3));
        $this->assertEquals(33, $integer->get());
    }

    public function testDiv_Positive_With_Negative()
    {
        $integer = new Utility\CentralinoInteger(-100);
        $this->assertTrue($integer->div(3));
        $this->assertEquals(-33, $integer->get());
    }

    public function testDiv_Negative_With_Negative()
    {
        $integer = new Utility\CentralinoInteger(-100);
        $this->assertTrue($integer->div(-2));
        $this->assertEquals(50, $integer->get());
    }

    public function testDiv_Invalid_Integer_Return_False()
    {
        $integer = new Utility\CentralinoInteger(123);
        $this->assertFalse($integer->div('231'));
        $this->assertEquals(123, $integer->get());
    }
}