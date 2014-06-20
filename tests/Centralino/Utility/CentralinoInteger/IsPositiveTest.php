<?php
namespace CentralinoInteger;

use Centralino\Utility;

class IsPositiveTest extends \PHPUnit_Framework_TestCase
{
    public function testIsPositive()
    {
        $integer = new Utility\CentralinoInteger(123);
        $this->assertTrue($integer->isPositive());
    }
}