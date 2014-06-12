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

   /**
    * @expectedException Centralino\Utility\UtilityException
    * @dataProvider invalidAddDurationPeriodsProvider
    */
    public function testAddSeconds_Invalid_Duration_Period_Throws($invalidInput)
    {
        $dateTime = new CentralinoDateTime('01-01-2014 13:40:10');
        $dateTime->addSeconds($invalidInput);
    }

   /**
    * @expectedException Centralino\Utility\UtilityException
    * @dataProvider invalidAddDurationPeriodsProvider
    */
    public function testAddMinutes_Invalid_Duration_Period_Throws($invalidInput)
    {
        $dateTime = new CentralinoDateTime('01-01-2014 13:40:10');
        $dateTime->addMinutes($invalidInput);
    }

   /**
    * @expectedException Centralino\Utility\UtilityException
    * @dataProvider invalidAddDurationPeriodsProvider
    */
    public function testAddHours_Invalid_Duration_Period_Throws($invalidInput)
    {
        $dateTime = new CentralinoDateTime('01-01-2014 13:40:10');
        $dateTime->addHours($invalidInput);
    }

   /**
    * @expectedException Centralino\Utility\UtilityException
    * @dataProvider invalidAddDurationPeriodsProvider
    */
    public function testAddMonths_Invalid_Duration_Period_Throws($invalidInput)
    {
        $dateTime = new CentralinoDateTime('01-01-2014 13:40:10');
        $dateTime->addMonths($invalidInput);
    }

   /**
    * @expectedException Centralino\Utility\UtilityException
    * @dataProvider invalidAddDurationPeriodsProvider
    */
    public function testAddYears_Invalid_Duration_Period_Throws($invalidInput)
    {
        $dateTime = new CentralinoDateTime('01-01-2014 13:40:10');
        $dateTime->addYears($invalidInput);
    }

    public function invalidAddDurationPeriodsProvider()
    {
        return array(
            array('1'),
            array(new \stdClass()),
            array(array()),
            array(1.11),
            array("1.11"),
            array(0.1),
            array(-11)
        );
    }
}