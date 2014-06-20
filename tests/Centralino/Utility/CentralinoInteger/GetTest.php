<?php
namespace CentralinoInteger;

use Centralino\Utility;

class GetTest extends \PHPUnit_Framework_TestCase
{
    public function testGet_Positive()
    {
        $integer = new Utility\CentralinoInteger(123);
        $this->assertEquals(123, $integer->get());
    }

    public function testGet_Negative()
    {
        $integer = new Utility\CentralinoInteger(-123);
        $this->assertEquals(-123, $integer->get());
    }
}