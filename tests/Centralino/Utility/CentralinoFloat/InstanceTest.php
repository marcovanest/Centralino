<?php
namespace CentralinoFloat;

use Centralino\Utility;

class InstanceTest extends \PHPUnit_Framework_TestCase
{
   /**
    * @expectedException Centralino\Utility\UtilityException
    */
    public function testCentralinoFloat_Invalid_float_Throws()
    {
        $float = new Utility\CentralinoFloat("Iñtërnâtiôn\xe9àlizætiøn");
    }

   /**
    * @expectedException Centralino\Utility\UtilityException
    */
    public function testCentralinoFloat_Null_Value_Throws()
    {
        $float = new Utility\CentralinoFloat(null);
    }

   /**
    * @expectedException Centralino\Utility\UtilityException
    */
    public function testCentralinoFloat_Float_Value_Throws()
    {
        $float = new Utility\CentralinoFloat(12344);
    }

    public function testCentralinoFloat_Valid_Positive_Value()
    {
        $float = new Utility\CentralinoFloat(12.12);

        $this->assertInstanceOf('\Centralino\Utility\CentralinoFloat', $float);
    }

    public function testCentralinoFloat_Valid_Negative_Value()
    {
        $float = new Utility\CentralinoFloat(-12.12);

        $this->assertInstanceOf('\Centralino\Utility\CentralinoFloat', $float);
    }
}