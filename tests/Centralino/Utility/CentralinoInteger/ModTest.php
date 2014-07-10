<?php
namespace CentralinoInteger;

use Centralino\Utility;

class ModTest extends \PHPUnit_Framework_TestCase
{
    public function testMod_Valid_Positive_Mod()
    {
        $integer = new Utility\CentralinoInteger(123);

        $mod = $integer->mod(15);
        $this->assertEquals(3, $mod);
    }

    public function testMod_Valid_Negative_Mod()
    {
        $integer = new Utility\CentralinoInteger(123);

        $mod = $integer->mod(-15);
        $this->assertEquals(3, $mod);
    }

    public function testMod_InValid_Mod()
    {
        $integer = new Utility\CentralinoInteger(123);
        $this->assertFalse($integer->mod("3213"));
    }

    /**
     * @expectedException Centralino\Utility\UtilityException
     */
    public function testMod_By_Zero_Throws()
    {
        $integer = new Utility\CentralinoInteger(123);
        $integer->mod(0);
    }
}
