<?php
namespace CentralinoString;

use Centralino\Utility;

class GetPartTest extends \PHPUnit_Framework_TestCase
{
    public function testPart()
    {
        $string = Utility\CentralinoString::create("Iñtërnâtiônàlizætiøn");
        $this->assertEquals("æ", $string->getPart(new Utility\CentralinoInteger(15), new Utility\CentralinoInteger(1)));
    }

    public function testPart_Empty()
    {
        $string = Utility\CentralinoString::create("");
        $this->assertEquals("", $string->getPart(new Utility\CentralinoInteger(0), new Utility\CentralinoInteger(1)));
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testPart_Invalid_Start_Throws()
    {
        $string = Utility\CentralinoString::create("Iñtërnâtiônàlizætiøn");
        $string->getPart(123, new Utility\CentralinoInteger(21221));
        $string->getPart(null, new Utility\CentralinoInteger(21221));
        $string->getPart("", new Utility\CentralinoInteger(21221));
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testPart_Invalid_Length_Throws()
    {
        $string = Utility\CentralinoString::create("Iñtërnâtiônàlizætiøn");
        $string->getPart(new Utility\CentralinoInteger(21221), 1234);
        $string->getPart(new Utility\CentralinoInteger(21221), "");
        $string->getPart(new Utility\CentralinoInteger(21221), array());
    }

    public function testPart_Invalid_Offset_Return_Empty_String()
    {
        $string = Utility\CentralinoString::create("Iñtërnâtiônàlizætiøn");
        $this->assertEquals("", $string->getPart(new Utility\CentralinoInteger(213), new Utility\CentralinoInteger(21221)));
    }
}