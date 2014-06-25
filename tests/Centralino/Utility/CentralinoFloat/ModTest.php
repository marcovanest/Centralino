<?php
namespace CentralinoFloat;

use Centralino\Utility;

class ModTest extends \PHPUnit_Framework_TestCase
{
    public function testMod_Valid_Positive_Mod()
    {
        $float = new Utility\CentralinoFloat(123.12);

        $mod = $float->mod(5);
        $this->assertInstanceOf('Centralino\Utility\CentralinoFloat', $mod);

        $this->assertEquals(3.12, $mod->get());
    }

    public function testMod_Valid_Negative_Mod()
    {
        $float = new Utility\CentralinoFloat(123.12);

        $mod = $float->mod(-5);
        $this->assertInstanceOf('Centralino\Utility\CentralinoFloat', $mod);

        $this->assertEquals(3.12, $mod->get());
    }

    public function testMod_InValid_Mod()
    {
        $float = new Utility\CentralinoFloat(123.12);
        $this->assertFalse($float->mod("3213"));
    }
}