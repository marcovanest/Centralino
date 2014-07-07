<?php
namespace CentralinoInteger;

use Centralino\Utility;

class SqrtTest extends \PHPUnit_Framework_TestCase
{
    public function testSqrt_Negative_Return_False()
    {
        $integer = new Utility\CentralinoInteger(-123);
        $this->assertFalse($integer->sqrt());
    }

    public function testSqrt_Positive_Get()
    {
        $integer = new Utility\CentralinoInteger(9);
        $this->assertEquals(3, $integer->sqrt());
    }
}
