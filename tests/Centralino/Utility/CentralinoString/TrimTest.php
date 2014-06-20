<?php
namespace CentralinoString;

use Centralino\Utility;

class TrimTest extends \PHPUnit_Framework_TestCase
{
    public function testTrim_ASCII_Characters_Only()
    {
        $string = new Utility\CentralinoString("    Internationalization    ");
        $this->assertEquals("Internationalization", $string->trim()->get());
    }

    public function testTrim_ASCII_Characters_Only_Right()
    {
        $string = new Utility\CentralinoString("Internationalization    ");
        $this->assertEquals("Internationalization", $string->trim()->get());
    }

    public function testTrim_ASCII_Characters_Only_Left()
    {
        $string = new Utility\CentralinoString("    Internationalization");
        $this->assertEquals("Internationalization", $string->trim()->get());
    }

    public function testTrim_Unicode_And_ASCII_Characters()
    {
        $string = new Utility\CentralinoString("    Iñtërnâtiônàlizætiøn    ");
        $this->assertEquals("Iñtërnâtiônàlizætiøn", $string->trim()->get());
    }

    public function testTrim_Unicode_And_ASCII_Characters_Right()
    {
        $string = new Utility\CentralinoString("Iñtërnâtiônàlizætiøn    ");
        $this->assertEquals("Iñtërnâtiônàlizætiøn", $string->trim()->get());
    }

    public function testTrim_Unicode_And_ASCII_Characters_Left()
    {
        $string = new Utility\CentralinoString("    Iñtërnâtiônàlizætiøn");
        $this->assertEquals("Iñtërnâtiônàlizætiøn", $string->trim()->get());
    }

    public function testTrim_Unicode_And_ASCII_Characters_No_Strip_Between_String()
    {
        $string = new Utility\CentralinoString("a    Iñtërnâtiônàlizætiøn    a");
        $this->assertEquals("a    Iñtërnâtiônàlizætiøn    a", $string->trim()->get());
    }

    public function testTrim_With_Custom_Character_Mask()
    {
        $string = new Utility\CentralinoString("ñIñtërñâtiôñàlizætiøñ");
        $this->assertEquals("Iñtërñâtiôñàlizætiø", $string->trim("ñ")->get());
    }

}