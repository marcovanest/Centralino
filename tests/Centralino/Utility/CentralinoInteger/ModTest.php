<?php
namespace CentralinoInteger;

use Centralino\Utility;

class ModTest extends \PHPUnit_Framework_TestCase
{
    public function testMod_Valid_Positive_Mod()
    {
        $integer = new Utility\CentralinoInteger(123);
        $this->assertEquals(3, $integer->mod(15));
    }

    public function testMod_Valid_Negative_Mod()
    {
        $integer = new Utility\CentralinoInteger(123);
        $this->assertEquals(3, $integer->mod(-15));
    }

    public function testMod_InValid_Mod()
    {
        $integer = new Utility\CentralinoInteger(123);
        $this->assertFalse($integer->mod("3213"));
    }
}