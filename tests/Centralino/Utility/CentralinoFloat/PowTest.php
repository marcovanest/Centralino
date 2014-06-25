<?php
namespace CentralinoFloat;

use Centralino\Utility;

class PowTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider baseNegativeExpPositiveProvider
     */
    public function testPow_Base_Negative_Exp_Positive($base, $exp, $ex)
    {
        $float = new Utility\CentralinoFloat($base);
        $this->assertTrue($float->pow($exp));
        $this->assertEqual($float->pow($exp));
    }

    /**
     * @dataProvider baseNegativeExpNegativeProvider
     */
    public function testPow_Base_Negative_Exp_Negative_Return_CentralinoFloat($base, $exp, $ex)
    {
        $float = new Utility\CentralinoFloat($base);
        $this->assertTrue($float->pow($exp));
    }

    /**
     * @dataProvider basePositiveExpPositiveProvider
     */
    public function testPow_Base_Positive_Exp_Positive_Return_CentralinoFloat($base, $exp, $ex)
    {
        $float = new Utility\CentralinoFloat($base);
        $this->assertTrue($float->pow($exp));
        $this->assertEquals($ex, $float->get());
    }

    public function testPow_Positive()
    {
        $float = new Utility\CentralinoFloat(123.12);
        $this->assertEquals(15129, $float->pow(2));
    }

    public function testPow_InValid_Pow()
    {
        $float = new Utility\CentralinoFloat(123.12);
        $this->assertFalse($float->pow("3213"));
    }

    public function baseNegativeExpNegativeProvider()
    {
        return call_user_func(function() {
            $a = array();
            for($i=-5.00; $i<-1.00; $i+=1.00)
            {
               for($j=-5.00; $j<-1.00; $j+=1.00)
                {
                    $a[] = array($i, $j, round(pow($i, $j),2));
                }
            }
            return $a;
        });
    }

    public function baseNegativeExpPositiveProvider()
    {
        return call_user_func(function() {
            $a = array();
            for($i=0.00; $i<5.00; $i+=1.00)
            {
               for($j=-5.00; $j<-1.00; $j+=1.00)
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
            for($i=0.00; $i<=5.00; $i+=1.00)
            {
               for($j=0.00; $j<5.00; $j+=1.00)
                {
                    $a[] = array($i, $j, round(pow($i, $j),2));
                }
            }
            return $a;
        });
    }
}