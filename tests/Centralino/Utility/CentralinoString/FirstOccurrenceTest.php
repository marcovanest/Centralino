<?php
namespace CentralinoString;

use Centralino\Utility;

class FirstOccurrenceTest extends \PHPUnit_Framework_TestCase
{
    public function testFirst_Occurrence_ASCII_Character()
    {
        $string = Utility\CentralinoString::create("Iñtërnâtiônàlizætiøn");
        $this->assertEquals(5, $string->firstOccurrence('n'));
    }

    public function testFirst_Occurrence_Non_ASCII_Character()
    {
        $string = Utility\CentralinoString::create("Iñtërnâtiônàlizætiøn");
        $this->assertEquals(6, $string->firstOccurrence('â'));
    }

   /**
    * @expectedException Centralino\Utility\UtilityException
    */
    public function testFirst_Occurrence_Empty_Needle_Throws()
    {
        $string = Utility\CentralinoString::create("Iñtërnâtiônàlizætiøn");
        $string->firstOccurrence("");
    }

    public function testFirst_Occurrence_On_Empty_String_Returns_False()
    {
        $string = Utility\CentralinoString::create("");
        $this->assertFalse($string->firstOccurrence("a"));
    }

    public function testFirst_Occurrence_Unfindable_Character_Return_False()
    {
        $string = Utility\CentralinoString::create("Iñtërnâtiônàlizætiøn");
        $this->assertFalse($string->firstOccurrence("q"));
    }

    public function testFirst_Occurence_With_Offset()
    {
        $string = Utility\CentralinoString::create("Iñtërñâtiôñàlizætiøñ");

        $this->assertEquals(10, $string->firstOccurrence("ñ", new Utility\CentralinoInteger(8)));
    }

   /**
    * @expectedException Centralino\Utility\UtilityException
    */
    public function testFirst_Occurence_With_Illegal_Offset_Throws()
    {
       $string = Utility\CentralinoString::create("Iñtërñâtiôñàlizætiøñ");
        $this->assertEquals(2,$string->firstOccurrence("ñ", new Utility\CentralinoInteger(21)));
    }
}