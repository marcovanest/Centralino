<?php
namespace Centralino\Utility;

class InstanceTest extends \PHPUnit_Framework_TestCase
{
   /**
    * @expectedException Centralino\Utility\UtilityException
    */
    public function testCentralinoString_Invalid_String_Throws()
    {
        $string = new CentralinoString("Iñtërnâtiôn\xe9àlizætiøn");
    }

    public function testCentralinoString_Valid()
    {
        $string = new CentralinoString("Iñtërnâtiônàlizætiøn");

        $this->assertInstanceOf('\Centralino\Utility\CentralinoString', $string);
    }

    public function testCentralinoString_Empty()
    {
        $string = new CentralinoString("");

        $this->assertInstanceOf('\Centralino\Utility\CentralinoString', $string);
    }
}