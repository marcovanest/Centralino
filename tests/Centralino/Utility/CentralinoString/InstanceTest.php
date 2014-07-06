<?php
namespace CentralinoString;

use Centralino\Utility;

class InstanceTest extends \PHPUnit_Framework_TestCase
{
   /**
    * @expectedException Centralino\Utility\UtilityException
    */
    public function testCentralinoString_Invalid_String_Throws()
    {
        $string = Utility\CentralinoString::create("Iñtërnâtiôn\xe9àlizætiøn");
    }

    public function testCentralinoString_Valid()
    {
        $string = Utility\CentralinoString::create("Iñtërnâtiônàlizætiøn");

        $this->assertInstanceOf('\Centralino\Utility\CentralinoString', $string);
    }

    public function testCentralinoString_Empty()
    {
        $string = Utility\CentralinoString::create("");

        $this->assertInstanceOf('\Centralino\Utility\CentralinoString', $string);
    }
}