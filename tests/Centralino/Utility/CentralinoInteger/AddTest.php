<?php
namespace CentralinoInteger;

use Centralino\Utility;

class AddTest extends \PHPUnit_Framework_TestCase
{
    public function testAdd_Valid_Integer_Return_True()
    {
        $integer = new Utility\CentralinoInteger(123);
        $this->assertTrue($integer->add(123));
        $this->assertEquals(246, $integer->get());
    }

    public function testAdd_Negative_To_Positive()
    {
        $integer = new Utility\CentralinoInteger(-10);
        $this->assertTrue($integer->add(30));
        $this->assertEquals(20, $integer->get());
    }

    public function testAdd_Negative_To_Negative()
    {
        $integer = new Utility\CentralinoInteger(-10);
        $this->assertTrue($integer->add(-10));
        $this->assertEquals(-20, $integer->get());
    }

    public function testAdd_Invalid_Integer_Return_False()
    {
        $integer = new Utility\CentralinoInteger(123);
        $this->assertFalse($integer->add('231'));
        $this->assertEquals(123, $integer->get());
    }
}