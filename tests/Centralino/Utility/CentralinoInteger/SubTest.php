<?php
namespace CentralinoInteger;

use Centralino\Utility;

class SubTest extends \PHPUnit_Framework_TestCase
{
    public function testSub_Valid_Integer_Return_True()
    {
        $integer = new Utility\CentralinoInteger(123);
        $this->assertTrue($integer->sub(122));
        $this->assertEquals(1, $integer->get());
    }

    public function testSub_Negative_To_Positive()
    {
        $integer = new Utility\CentralinoInteger(-10);
        $this->assertTrue($integer->sub(30));
        $this->assertEquals(-40, $integer->get());
    }

    public function testSub_Negative_To_Negative()
    {
        $integer = new Utility\CentralinoInteger(-10);
        $this->assertTrue($integer->sub(-10));
        $this->assertEquals(0, $integer->get());
    }

    public function testSub_Invalid_Integer_Return_False()
    {
        $integer = new Utility\CentralinoInteger(123);
        $this->assertFalse($integer->sub('231'));
        $this->assertEquals(123, $integer->get());
    }
}