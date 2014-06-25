<?php
namespace CentralinoFloat;

use Centralino\Utility;

class AbsTest extends \PHPUnit_Framework_TestCase
{
    public function testAbs_Negative()
    {
        $float = new Utility\CentralinoFloat(-123.12);

        $abs = $float->abs();
        $this->assertInstanceOf('Centralino\Utility\CentralinoFloat', $abs);
        $this->assertEquals(-123.12, $float->get());
        $this->assertEquals(123.12, $abs->get());
    }

    public function testAbs_Positive()
    {
        $float = new Utility\CentralinoFloat(123.12);

        $abs = $float->abs();
        $this->assertInstanceOf('Centralino\Utility\CentralinoFloat', $abs);
        $this->assertEquals(123.12, $abs->get());
        $this->assertEquals(123.12, $float->get());
    }
}