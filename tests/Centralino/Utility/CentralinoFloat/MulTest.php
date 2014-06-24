<?php
namespace CentralinoFloat;

use Centralino\Utility;

class MulTest extends \PHPUnit_Framework_TestCase
{
    public function testDivide_Valid_Float_Return_True()
    {
        $float = new Utility\CentralinoFloat(123.61);
        $this->assertTrue($float->mul(2));
        $this->assertEquals(247.22, $float->get());
    }

    public function testMul_Invalid_Float_Return_False()
    {
        $float = new Utility\CentralinoFloat(123.98);
        $this->assertFalse($float->mul('231'));
        $this->assertEquals(123.98, $float->get());
    }

    public function testMul_Positive_With_Negative()
    {
        $float = new Utility\CentralinoFloat(3.33);
        $this->assertTrue($float->mul(-3));
        $this->assertEquals(-9.99, $float->get());
    }

    public function testMul_Positive_With_Zero()
    {
        $float = new Utility\CentralinoFloat(3.00);
        $this->assertTrue($float->mul(0));
        $this->assertEquals(0, $float->get());
    }

    public function testMul_Negative_With_Negative()
    {
        $float = new Utility\CentralinoFloat(-3.34);
        $this->assertTrue($float->mul(-3.34));
        $this->assertEquals(11.16, $float->get());
    }

    public function testMul_Negative_With_Zero()
    {
        $float = new Utility\CentralinoFloat(-3.5);
        $this->assertTrue($float->mul(0));
        $this->assertEquals(0, $float->get());
    }
}