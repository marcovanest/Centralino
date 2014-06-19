<?php
namespace Centralino\Utility;

class GetPartTest extends \PHPUnit_Framework_TestCase
{
    public function testPart()
    {
        $string = new CentralinoString("Iñtërnâtiônàlizætiøn");
        $this->assertEquals("æ", $string->getPart(15,1));
    }

    public function testPart_Empty()
    {
        $string = new CentralinoString("");
        $this->assertEquals("", $string->getPart(0,1));
    }
}