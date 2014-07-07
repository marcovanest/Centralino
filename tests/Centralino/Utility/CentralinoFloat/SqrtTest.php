<?php
namespace CentralinoFloat;

use Centralino\Utility;

class SqrtTest extends \PHPUnit_Framework_TestCase
{
    public function testSqrt_Negative_Return_False()
    {
        $float = new Utility\CentralinoFloat(-123.22);
        $this->assertFalse($float->sqrt());
    }

    public function testSqrt_Positive_Return_CentralinoFloat_Instance()
    {
        $float = new Utility\CentralinoFloat(123.34);
        $this->assertTrue(\Centralino\Utility\CentralinoFloat::isFloat($float->sqrt()));
    }

    public function testSqrt_Positive_Get()
    {
        $float = new Utility\CentralinoFloat(9.59);
        $sqrt = new Utility\CentralinoFloat($float->sqrt());
        $this->assertEquals(3.1, $sqrt->get());
    }
}
