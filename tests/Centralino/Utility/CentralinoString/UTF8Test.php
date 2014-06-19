<?php
namespace Centralino\Utility;

class UTF8Test extends \PHPUnit_Framework_TestCase
{
    public function testIsUTF8()
    {
        $string = new CentralinoString("Iñtërnâtiônàlizætiøn");
        $this->assertTrue($string->isUTF8());
    }
}