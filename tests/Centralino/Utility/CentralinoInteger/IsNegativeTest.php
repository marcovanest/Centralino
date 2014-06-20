<?php
namespace CentralinoInteger;

use Centralino\Utility;

class IsNegativeTest extends \PHPUnit_Framework_TestCase
{
    public function testIsNegative()
    {
        $integer = new Utility\CentralinoInteger(-123);
        $this->assertTrue($integer->isNegative());
    }
}