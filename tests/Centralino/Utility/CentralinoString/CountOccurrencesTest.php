<?php
namespace CentralinoString;

use Centralino\Utility;

class CountOccurrencesTest extends \PHPUnit_Framework_TestCase
{
    public function testGetOccurences_ASCII_Character()
    {
        $string = Utility\CentralinoString::create("Iñtërnâtiônàlizætiøn");
        $this->assertEquals(3, $string->countOccurrences('n'));
    }

    public function testGetOccurences_Non_ASCII_Character()
    {
        $string = Utility\CentralinoString::create("Iñtërnâtiônàlizætiøn");
        $this->assertEquals(1, $string->countOccurrences('ñ'));
    }

   /**
    * @expectedException Centralino\Utility\UtilityException
    */
    public function testGetOccurences_Empty_Needle_Throws()
    {
        $string = Utility\CentralinoString::create("Iñtërnâtiônàlizætiøn");
        $string->countOccurrences("");
    }

    public function testGetOccurences_On_Empty_String()
    {
        $string = Utility\CentralinoString::create("");
        $this->assertEquals(0, $string->countOccurrences("æ"));
    }
}