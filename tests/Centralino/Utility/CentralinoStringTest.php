<?php
namespace Centralino\Utility;

class CentralinoStringTest extends \PHPUnit_Framework_TestCase
{
   /**
    * @expectedException Centralino\Utility\UtilityException
    */
    public function testCentralinoString_Invalid_String_Throws()
    {
        $string = new CentralinoString(100.00);
    }

    public function testCentralinoString_Valid()
    {
        $string = new CentralinoString("Ik ben een string");

        $this->assertInstanceOf('\Centralino\Utility\CentralinoString', $string);
    }

    public function testGet()
    {
        $string = new CentralinoString("Ik ben een string");
        $this->assertEquals('Ik ben een string', $string->get());
    }

    public function testGetLength()
    {
        $string = new CentralinoString("Ik ben een string®");
        $this->assertEquals(18, $string->getLength());
    }

    public function testIsUTF8()
    {
        $string = new CentralinoString("this is an invalid char '\xe9' here");
        $this->assertTrue($string->isUTF8());
    }
}