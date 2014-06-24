<?php
namespace CentralinoFloat;

use Centralino\Utility;

class IsPositiveTest extends \PHPUnit_Framework_TestCase
{
    public function testIsPositive()
    {
        $float = new Utility\CentralinoFloat(123.67);
        $this->assertTrue($float->isPositive());
    }
}