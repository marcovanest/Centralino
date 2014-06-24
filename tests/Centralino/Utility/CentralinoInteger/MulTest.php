<?php
namespace CentralinoInteger;

use Centralino\Utility;

class MulTest extends \PHPUnit_Framework_TestCase
{
    public function testDivide_Valid_Integer_Return_True()
    {
        $integer = new Utility\CentralinoInteger(123);
        $this->assertTrue($integer->mul(2));
        $this->assertEquals(246, $integer->get());
    }

    public function testMul_Invalid_Integer_Return_False()
    {
        $integer = new Utility\CentralinoInteger(123);
        $this->assertFalse($integer->mul('231'));
        $this->assertEquals(123, $integer->get());
    }

    public function testMul_Positive_With_Negative()
    {
        $integer = new Utility\CentralinoInteger(3);
        $this->assertTrue($integer->mul(-3));
        $this->assertEquals(-9, $integer->get());
    }

    public function testMul_Positive_With_Zero()
    {
        $integer = new Utility\CentralinoInteger(3);
        $this->assertTrue($integer->mul(0));
        $this->assertEquals(0, $integer->get());
    }

    public function testMul_Negative_With_Negative()
    {
        $integer = new Utility\CentralinoInteger(-3);
        $this->assertTrue($integer->mul(-3));
        $this->assertEquals(9, $integer->get());
    }

    public function testMul_Negative_With_Zero()
    {
        $integer = new Utility\CentralinoInteger(-3);
        $this->assertTrue($integer->mul(0));
        $this->assertEquals(0, $integer->get());
    }
}