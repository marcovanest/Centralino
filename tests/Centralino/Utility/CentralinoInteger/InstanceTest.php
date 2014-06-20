<?php
namespace CentralinoInteger;

use Centralino\Utility;

class InstanceTest extends \PHPUnit_Framework_TestCase
{
   /**
    * @expectedException Centralino\Utility\UtilityException
    */
    public function testCentralinoInteger_Invalid_Integer_Throws()
    {
        $integer = new Utility\CentralinoInteger("Iñtërnâtiôn\xe9àlizætiøn");
    }

   /**
    * @expectedException Centralino\Utility\UtilityException
    */
    public function testCentralinoInteger_Null_Throws()
    {
        $integer = new Utility\CentralinoInteger(null);
    }

    public function testCentralinoInteger_Valid_Positive_Value()
    {
        $integer = new Utility\CentralinoInteger(12);

        $this->assertInstanceOf('\Centralino\Utility\CentralinoInteger', $integer);
    }

    public function testCentralinoInteger_Valid_Negative_Value()
    {
        $integer = new Utility\CentralinoInteger(-12);

        $this->assertInstanceOf('\Centralino\Utility\CentralinoInteger', $integer);
    }
}