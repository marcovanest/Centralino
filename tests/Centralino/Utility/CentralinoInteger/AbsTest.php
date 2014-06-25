<?php
namespace CentralinoInteger;

use Centralino\Utility;

class AbsTest extends \PHPUnit_Framework_TestCase
{
    public function testAbs_Negative()
    {
        $integer = new Utility\CentralinoInteger(-123);

        $abs = $integer->abs();
        $this->assertInstanceOf('Centralino\Utility\CentralinoInteger', $abs);
        $this->assertEquals(-123, $integer->get());
        $this->assertEquals(123, $abs->get());
    }

    public function testAbs_Positive()
    {
        $integer = new Utility\CentralinoInteger(123);

        $abs = $integer->abs();
        $this->assertInstanceOf('Centralino\Utility\CentralinoInteger', $abs);
        $this->assertEquals(123, $abs->get());
        $this->assertEquals(123, $integer->get());
    }
}