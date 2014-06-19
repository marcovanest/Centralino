<?php
namespace Centralino\Utility;

class CountOccurrencesTest extends \PHPUnit_Framework_TestCase
{
    public function testGetOccurences_ASCII_Character()
    {
        $string = new CentralinoString("Iñtërnâtiônàlizætiøn");
        $this->assertEquals(3, $string->countOccurrences('n'));
    }

    public function testGetOccurences_Non_ASCII_Character()
    {
        $string = new CentralinoString("Iñtërnâtiônàlizætiøn");
        $this->assertEquals(1, $string->countOccurrences('ñ'));
    }

   /**
    * @expectedException Centralino\Utility\UtilityException
    */
    public function testGetOccurences_Empty_Needle_Throws()
    {
        $string = new CentralinoString("Iñtërnâtiônàlizætiøn");
        $string->countOccurrences("");
    }
}