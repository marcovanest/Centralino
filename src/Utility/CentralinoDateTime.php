<?php
namespace Centralino\Utility;

class CentralinoDateTime extends UtilityAbstract implements UtilityInterface
{
    const DATE_FORMAT     = 'Y-m-d';
    const TIME_FORMAT     = 'H:i:s';
    const DATETIME_FORMAT = 'Y-m-d H:i:s';
    const TIME_ZONE       = 'UTC';

    private $timezone;

    public function __construct($dateTimeString = null, \DateTimeZone $dateTimeZone = null)
    {
        try {
            $this->datetime = new \DateTime($dateTimeString, $dateTimeZone);
        } catch (\Exception $exception) {
            $this->throwException('Invalid date given');
        }
    }

    public function get()
    {
        return $this->getDateTime();
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
        $this->addPeriodAmount('P', $days, 'D');
    }

    public function subDays($days)
    {
        $this->subPeriodAmount('P', $days, 'D');
    }

    public function addMonths($months)
    {
        $this->addPeriodAmount('P', $months, 'M');
    }

    public function subMonths($months)
    {
        $this->subPeriodAmount('P', $months, 'M');
    }

    public function addYears($years)
    {
        $this->addPeriodAmount('P', $years, 'Y');
    }

    public function subYears($years)
    {
        $this->subPeriodAmount('P', $years, 'Y');
    }

    public function addSeconds($seconds)
    {
        $this->addPeriodAmount('PT', $seconds, 'S');
    }

    public function subSeconds($seconds)
    {
        $this->subPeriodAmount('PT', $seconds, 'S');
    }

    public function addMinutes($minutes)
    {
        $this->addPeriodAmount('PT', $minutes, 'M');
    }

    public function subMinutes($seconds)
    {
        $this->subPeriodAmount('PT', $seconds, 'M');
    }

    public function addHours($hours)
    {
        $this->addPeriodAmount('PT', $hours, 'H');
    }

    public function subHours($seconds)
    {
        $this->subPeriodAmount('PT', $seconds, 'H');
    }

    public function formatDateTime($formatSpecified, \DateTimeZone $dateTimeZone = null)
    {
        if (! is_null($dateTimeZone)) {
            $this->datetime->setTimeZone($dateTimeZone);
        }

        try {
            return $this->datetime->format($formatSpecified);
        } catch (\UtilityException $exception) {
            throw $exception;
        }
    }

    public function setTimeZone(\DateTimeZone $dateTimeZone)
    {
        $this->datetime->setTimeZone($dateTimeZone);
    }

    public function getTimeZone()
    {
        return $this->datetime->getTimeZone();
    }

    public function getOffset()
    {
        return $this->datetime->getOffset();
    }

    private function addPeriodAmount($period, $amount, $perioddesignator)
    {
        if (CentralinoInteger::isInteger($amount) === false) {
            $this->throwException('Invalid period amount; Not a integer');
        }

        try {
            $this->datetime->add(new \DateInterval($period.$amount.$perioddesignator));
        } catch (\Exception $exception) {
            $this->throwException('Invalid add period amount');
        }
    }

    private function subPeriodAmount($period, $amount, $perioddesignator)
    {
        if (CentralinoInteger::isInteger($amount) === false) {
            $this->throwException('Invalid period amount; Not a integer');
        }

        try {
            $this->datetime->sub(new \DateInterval($period.$amount.$perioddesignator));
        } catch (\Exception $exception) {
            $this->throwException('Invalid sub period amount');
        }
    }
}
