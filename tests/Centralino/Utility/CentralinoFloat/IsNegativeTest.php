<?php
namespace CentralinoFloat;

use Centralino\Utility;

class IsNegativeTest extends \PHPUnit_Framework_TestCase
{
    public function testIsNegative()
    {
        $float = new Utility\CentralinoFloat(-123.86);
        $this->assertTrue($float->isNegative());
    }
}