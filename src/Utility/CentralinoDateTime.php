<?php
namespace Centralino\Utility;

class CentralinoDateTime extends \DateTime
{
    CONST DATE_FORMAT     = 'Y-m-d';
    CONST TIME_FORMAT     = 'H:i:s';
    CONST DATETIME_FORMAT = 'Y-m-d H:i:s';
    CONST TIME_ZONE       = 'UTC';

    private $timezone;

    public function __construct($dateTimeString = null, \DateTimeZone $dateTimeZone = null)
    {
        try{
           parent::__construct($dateTimeString, ! is_null($dateTimeZone) ? $dateTimeZone : new \DateTimeZone(self::TIME_ZONE) );

           $this->timezone = parent::getTimezone();
        }catch(\Exception $exception) {
            throw new UtilityException("Invalid date given");
        }
    }

    public function __toString()
    {
        return $this->formatDateTime(self::DATETIME_FORMAT);
    }

    public function getDate(\DateTimeZone $dateTimeZone = null)
    {
        return $this->formatDateTime(self::DATE_FORMAT, $dateTimeZone);
    }

    public function getTime(\DateTimeZone $dateTimeZone = null)
    {
        return $this->formatDateTime(self::TIME_FORMAT, $dateTimeZone);
    }

    public function getDateTime(\DateTimeZone $dateTimeZone = null)
    {
        return $this->formatDateTime(self::DATETIME_FORMAT);
    }

    public function addDays($days)
    {
        $this->addAmount('P', $days, 'D');
    }

    public function subDays($days)
    {
        $this->subAmount('P', $days, 'D');
    }

    public function addMonths($months)
    {
        $this->addAmount('P', $months, 'M');
    }

    public function subMonths($months)
    {
        $this->subAmount('P', $months, 'M');
    }

    public function addYears($years)
    {
        $this->addAmount('P', $years, 'Y');
    }

    public function subYears($years)
    {
        $this->subAmount('P', $years, 'Y');
    }

    public function addSeconds($seconds)
    {
        $this->addAmount('PT', $seconds, 'S');
    }

    public function subSeconds($seconds)
    {
        $this->subAmount('PT', $seconds, 'S');
    }

    public function addMinutes($minutes)
    {
        $this->addAmount('PT', $minutes, 'M');
    }

    public function subMinutes($seconds)
    {
        $this->subAmount('PT', $seconds, 'M');
    }

    public function addHours($hours)
    {
        $this->addAmount('PT', $hours, 'H');
    }

    public function subHours($seconds)
    {
        $this->subAmount('PT', $seconds, 'H');
    }

    public function formatDateTime($formatSepcified, \DateTimeZone $dateTimeZone = null)
    {
        if( ! is_null($dateTimeZone)) {
            $this->setTimeZone($dateTimeZone);
        }

        try {
            return parent::format($formatSepcified);
        }catch(\UtilityException $exception) {
            throw $exception;
        }
    }

    private function addAmount($period, $amount, $perioddesignator)
    {
        try{
            $amount = new CentralinoInteger($amount);
            parent::add(new \DateInterval($period.$amount->get().$perioddesignator));
        }catch(UtilityException $exception) {
           throw new UtilityException('Invalid amount; Not a integer');
        }catch(\Exception $exception) {
           throw new UtilityException('Invalid add amount');
        }
    }

    private function subAmount($period, $amount, $perioddesignator)
    {
        try{
            $amount = new CentralinoInteger($amount);
            parent::sub(new \DateInterval($period.$amount->get().$perioddesignator));
        }catch(UtilityException $exception) {
           throw new UtilityException('Invalid amount; Not a integer');
        }catch(\Exception $exception) {
           throw new UtilityException('Invalid sub amount');
        }
    }
}