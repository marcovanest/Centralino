<?php
namespace CentralinoString;

use Centralino\Utility;

class GetLengthTest extends \PHPUnit_Framework_TestCase
{
    public function testLength()
    {
        $string = new Utility\CentralinoString("Iñtërnâtiônàlizætiøn");
        $this->assertEquals(20, $string->getLength());
    }

    public function testLenght_Only_ASCII_Characters()
    {
        $string = new Utility\CentralinoString("Internationalization");
        $this->assertEquals(20, $string->getLength());
    }

    public function testLength_Empty()
    {
        $string = new Utility\CentralinoString("");
        $this->assertEquals(0, $string->getLength());
    }
}