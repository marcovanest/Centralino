<?php
namespace CentralinoInteger;

use Centralino\Utility;

class PowTest extends \PHPUnit_Framework_TestCase
{
    public function testPow_Base_Negative_Exp_Positive()
    {
        $integer = new Utility\CentralinoInteger(-123);
        $result = $integer->pow(2);
        $this->assertTrue($result);
    }

    /**
     * @dataProvider baseNegativeExpNegativeProvider
     */
    public function testPow_Base_Negative_Exp_Negative_Return_CentralinoFloat($base, $exp, $ex)
    {
        $integer = new Utility\CentralinoInteger($base);
        $result = $integer->pow($exp);
        $this->assertInstanceOf('Centralino\Utility\CentralinoFloat', $result);
        $this->assertEquals($ex, $result->get());
    }

    /**
     * @dataProvider basePositiveExpPositiveProvider
     */
    public function testPow_Base_Positive_Exp_Positive_Return_CentralinoFloat($base, $exp, $ex)
    {
        $integer = new Utility\CentralinoInteger($base);
        $this->assertTrue($integer->pow($exp));
        $this->assertEquals($ex, $integer->get());
    }

    public function testPow_Positive()
    {
        $integer = new Utility\CentralinoInteger(123);
        $this->assertEquals(15129, $integer->pow(2));
    }

    public function baseNegativeExpNegativeProvider()
    {
        return call_user_func(function() {
            $a = array();
            for($i=-5; $i<-1; $i++)
            {
               for($j=-5; $j<-1; $j++)
                {
                    $a[] = array($i, $j, round(pow($i, $j),2));
                }
            }
            return $a;
        });
    }

    public function basePositiveExpPositiveProvider()
    {
        return call_user_func(function() {
            $a = array();
            for($i=0; $i<=5; $i++)
            {
               for($j=0; $j<5; $j++)
                {
                    $a[] = array($i, $j, round(pow($i, $j),2));
                }
            }
            return $a;
        });
    }
}