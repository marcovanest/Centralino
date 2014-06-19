<?php
namespace Centralino\Utility;

class GetLengthTest extends \PHPUnit_Framework_TestCase
{
    public function testLength()
    {
        $string = new CentralinoString("Iñtërnâtiônàlizætiøn");
        $this->assertEquals(20, $string->getLength());
    }

    public function testLenght_Only_ASCII_Characters()
    {
        $string = new CentralinoString("Internationalization");
        $this->assertEquals(20, $string->getLength());
    }

    public function testLength_Empty()
    {
        $string = new CentralinoString("");
        $this->assertEquals(0, $string->getLength());
    }
}