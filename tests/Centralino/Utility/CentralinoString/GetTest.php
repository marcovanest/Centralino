<?php
namespace CentralinoString;

use Centralino\Utility;

class GetTest extends \PHPUnit_Framework_TestCase
{
    public function testGet()
    {
        $string = new Utility\CentralinoString("Iñtërnâtiônàlizætiøn");
        $this->assertEquals('Iñtërnâtiônàlizætiøn', $string->get());
    }
}