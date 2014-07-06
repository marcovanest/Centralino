<?php
namespace CentralinoString;

use Centralino\Utility;

class GetLengthTest extends \PHPUnit_Framework_TestCase
{
    public function testLength()
    {
        $string = Utility\CentralinoString::create("Iñtërnâtiônàlizætiøn");
        $this->assertEquals(20, $string->getLength());
    }

    public function testLenght_Only_ASCII_Characters()
    {
        $string = Utility\CentralinoString::create("Internationalization");
        $this->assertEquals(20, $string->getLength());
    }

    public function testLength_Empty()
    {
        $string = Utility\CentralinoString::create("");
        $this->assertEquals(0, $string->getLength());
    }
}