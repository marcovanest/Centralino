<?php
namespace Centralino\Utility;

class LastOccurrenceTest extends \PHPUnit_Framework_TestCase
{
    public function testLast_Occurrence_ASCII_Character()
    {
        $string = new CentralinoString("Iñtërnâtiônàlizætiøn");
        $this->assertEquals(17, $string->lastOccurrence('i'));
    }

    public function testLast_Occurrence_Non_ASCII_Character()
    {
        $string = new CentralinoString("Iñtërnâtiônâlizætiøn");
        $this->assertEquals(11, $string->lastOccurrence('â'));
    }

   /**
    * @expectedException Centralino\Utility\UtilityException
    */
    public function testLast_Occurrence_Empty_Needle_Throws()
    {
        $string = new CentralinoString("Iñtërnâtiônàlizætiøn");
        $string->lastOccurrence("");
    }

    public function testLast_Occurrence_On_Empty_String_Returns_False()
    {
        $string = new CentralinoString("");
        $this->assertFalse($string->lastOccurrence("a"));
    }

    public function testLast_Occurrence_Unfindable_Character_Return_False()
    {
        $string = new CentralinoString("Iñtërnâtiônàlizætiøn");
        $this->assertFalse($string->lastOccurrence("q"));
    }

    public function testLast_Occurence_With_Offset()
    {
        $string = new CentralinoString("Iñtërñâtiôñàlizætiøñ");
        $this->assertEquals(19, $string->lastOccurrence("ñ", 8));
    }

   /**
    * @expectedException Centralino\Utility\UtilityException
    */
    public function testLast_Occurence_With_Illegal_Offset_Throws()
    {
       $string = new CentralinoString("Iñtërñâtiôñàlizætiøñ");
        $this->assertEquals(2,$string->lastOccurrence("ñ", 21));
    }

}