<?php
namespace Centralino\Utility;

class GetTest extends \PHPUnit_Framework_TestCase
{
    public function testGet()
    {
        $string = new CentralinoString("Iñtërnâtiônàlizætiøn");
        $this->assertEquals('Iñtërnâtiônàlizætiøn', $string->get());
    }
}