<?php
namespace CentralinoString;

use Centralino\Utility;

class UTF8Test extends \PHPUnit_Framework_TestCase
{
    public function testIsUTF8()
    {
        $string = new Utility\CentralinoString("Iñtërnâtiônàlizætiøn");
        $this->assertTrue($string->isUTF8());
    }
}