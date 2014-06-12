<?php
namespace Centralino\Utility;

class CentralinoDateTimeTest extends \PHPUnit_Framework_TestCase
{
   /**
    * @expectedException Centralino\Utility\UtilityException
    */
    public function testCentralinoDateTime_Invalid_Date_Throws()
    {
        $dateTime = new CentralinoDateTime('invalid date must throw exception');
    }

    public function testCentralinoDateTime_Valid_Date()
    {
        $dateTime = new CentralinoDateTime('01-01-2014');

        $this->assertInstanceOf('Centralino\Utility\CentralinoDateTime', $dateTime);
    }

    public function testAddSeconds_Invalid_Integer_Amount_Throws()
    {
        $dateTime = new CentralinoDateTime('01-01-2014 13:40:10');
        $dateTime->addSeconds('1');
    }
}