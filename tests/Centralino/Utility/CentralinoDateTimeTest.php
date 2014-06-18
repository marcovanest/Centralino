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

    public function testGetDate_Default_Format()
    {
        $dateTime = new CentralinoDateTime('01-01-2014 13:40:10');

        $this->assertEquals('2014-01-01', $dateTime->getDate());
    }

    public function testGetTime_Default_Format()
    {
        $dateTime = new CentralinoDateTime('01-01-2014 13.40.10');

        $this->assertEquals('13:40:10', $dateTime->getTime());
    }

    public function testGetDateTime_Default_Format()
    {
        $dateTime = new CentralinoDateTime('01-01-2014 13.40.10');

        $this->assertEquals('2014-01-01 13:40:10', $dateTime->getDateTime());
    }

    public function testCentralinoDateTime_With_TimeZone_Set()
    {
       $dateTimeUTC = new CentralinoDateTime('2014-01-01 14:34:12', new \DateTimeZone('UTC'));

       $this->assertEquals('UTC', $dateTimeUTC->getTimeZone()->getName());
    }

    /**
     * @expectedException PHPUnit_Framework_Error
     */
    public function testCentralinoDateTime_With_Invalid_Timezone_Throws()
    {
        $dateTime = new CentralinoDateTime('01-01-2014 13.40.10', 'UTC');
    }

    public function testGetDateTime_With_Valid_TimeZone()
    {
        $dateTime = new CentralinoDateTime('01-01-2014 13.40.10', new \DateTimeZone('UTC'));
        $this->assertEquals('2014-01-01 13:40:10', $dateTime->getDateTime());
    }

    /**
     * @dataProvider timezonesProvider
     */
    public function testSetTimeZones_Check_Zone($tz)
    {
       $dateTimeUTC = new CentralinoDateTime('2014-01-01 14:34:12', new \DateTimeZone('UTC'));

       $dateTimeUTC->setTimeZone($tz);

       $this->assertEquals($tz->getName(), $dateTimeUTC->getTimeZone()->getName());
    }

    /**
     * @dataProvider timezonesProvider
     */
    public function testSetTimeZones_Check_Offset($tz, $offset)
    {
       $dateTimeUTC = new CentralinoDateTime(null, $tz);

       $this->assertEquals($offset, $dateTimeUTC->getOffset());
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

    public function testAddSeconds_Valid_Duration_Period()
    {
        $dateTime = new CentralinoDateTime('01-01-2014 13:40:10');
        $dateTime->addSeconds(30);

        $this->assertEquals('2014-01-01 13:40:40', $dateTime->getDateTime());
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

    public function testAddMinutes_Valid_Duration_Period()
    {
        $dateTime = new CentralinoDateTime('01-01-2014 13:40:10');
        $dateTime->addMinutes(30);

        $this->assertEquals('2014-01-01 14:10:10', $dateTime->getDateTime());
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

    public function testAddHours_Valid_Duration_Period()
    {
        $dateTime = new CentralinoDateTime('01-01-2014 13:40:10');
        $dateTime->addHours(12);

        $this->assertEquals('2014-01-02 01:40:10', $dateTime->getDateTime());
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

    public function testAddMonths_Valid_Duration_Period()
    {
        $dateTime = new CentralinoDateTime('01-01-2014 13:40:10');
        $dateTime->addMonths(2);

        $this->assertEquals('2014-03-01 13:40:10', $dateTime->getDateTime());
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

    public function testAddYears_Valid_Duration_Period()
    {
        $dateTime = new CentralinoDateTime('01-01-2014 13:40:10');
        $dateTime->addYears(2);

        $this->assertEquals('2016-01-01 13:40:10', $dateTime->getDateTime());
    }

   /**
    * @expectedException Centralino\Utility\UtilityException
    * @dataProvider invalidAddDurationPeriodsProvider
    */
    public function testSubSeconds_Invalid_Duration_Period_Throws($invalidInput)
    {
        $dateTime = new CentralinoDateTime('01-01-2014 13:40:10');
        $dateTime->subSeconds($invalidInput);
    }

    public function testSubSeconds_Valid_Duration_Period()
    {
        $dateTime = new CentralinoDateTime('01-01-2014 13:40:10');
        $dateTime->SubSeconds(30);

        $this->assertEquals('2014-01-01 13:39:40', $dateTime->getDateTime());
    }

   /**
    * @expectedException Centralino\Utility\UtilityException
    * @dataProvider invalidAddDurationPeriodsProvider
    */
    public function testSubMinutes_Invalid_Duration_Period_Throws($invalidInput)
    {
        $dateTime = new CentralinoDateTime('01-01-2014 13:40:10');
        $dateTime->subMinutes($invalidInput);
    }

    public function testSubMinutes_Valid_Duration_Period()
    {
        $dateTime = new CentralinoDateTime('01-01-2014 13:40:10');
        $dateTime->SubMinutes(30);

        $this->assertEquals('2014-01-01 13:10:10', $dateTime->getDateTime());
    }

   /**
    * @expectedException Centralino\Utility\UtilityException
    * @dataProvider invalidAddDurationPeriodsProvider
    */
    public function testSubHours_Invalid_Duration_Period_Throws($invalidInput)
    {
        $dateTime = new CentralinoDateTime('01-01-2014 13:40:10');
        $dateTime->subHours($invalidInput);
    }

    public function testSubHours_Valid_Duration_Period()
    {
        $dateTime = new CentralinoDateTime('01-01-2014 13:40:10');
        $dateTime->SubHours(10);

        $this->assertEquals('2014-01-01 03:40:10', $dateTime->getDateTime());
    }

   /**
    * @expectedException Centralino\Utility\UtilityException
    * @dataProvider invalidAddDurationPeriodsProvider
    */
    public function testSubMonths_Invalid_Duration_Period_Throws($invalidInput)
    {
        $dateTime = new CentralinoDateTime('01-01-2014 13:40:10');
        $dateTime->subMonths($invalidInput);
    }

    public function testSubMonths_Valid_Duration_Period()
    {
        $dateTime = new CentralinoDateTime('01-01-2014 13:40:10');
        $dateTime->SubMonths(10);

        $this->assertEquals('2013-03-01 13:40:10', $dateTime->getDateTime());
    }

   /**
    * @expectedException Centralino\Utility\UtilityException
    * @dataProvider invalidAddDurationPeriodsProvider
    */
    public function testSubYears_Invalid_Duration_Period_Throws($invalidInput)
    {
        $dateTime = new CentralinoDateTime('01-01-2014 13:40:10');
        $dateTime->subYears($invalidInput);
    }

    public function testSubYears_Valid_Duration_Period()
    {
        $dateTime = new CentralinoDateTime('01-01-2014 13:40:10');
        $dateTime->SubYears(10);

        $this->assertEquals('2004-01-01 13:40:10', $dateTime->getDateTime());
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

    public function timezonesProvider()
    {
       return new \ArrayIterator(call_user_func( function() {
            $timezones = new \ArrayIterator( \DateTimeZone::listIdentifiers(\DateTimeZone::ALL) );
            $dataProvider = array();

            foreach ($timezones as $timezone) {
               $tz = new \DateTimeZone($timezone);
               $dataProvider[] = array($tz, $tz->getOffset(new \DateTime(null)));
            }
            return $dataProvider;

            })
       );
    }
}