<?php
namespace CentralinoFloat;

use Centralino\Utility;

class AddTest extends \PHPUnit_Framework_TestCase
{
    public function testAdd_Valid_Integer_Return_True()
    {
        $float = new Utility\CentralinoFloat(123.12);
        $this->assertTrue($float->add(0.12));
        $this->assertEquals(123.24, $float->get());
    }

    public function testAdd_Negative_To_Positive()
    {
        $float = new Utility\CentralinoFloat(-10.99);
        $this->assertTrue($float->add(0.01));
        $this->assertEquals(-10.98, $float->get());
    }

    public function testAdd_Negative_To_Negative()
    {
        $float = new Utility\CentralinoFloat(-10.99);
        $this->assertTrue($float->add(-0.01));
        $this->assertEquals(-11.00, $float->get());
    }

    public function testAdd_Invalid_float_Return_False()
    {
        $float = new Utility\CentralinoFloat(123.12);
        $this->assertFalse($float->add('231'));
        $this->assertEquals(123.12, $float->get());
    }
}