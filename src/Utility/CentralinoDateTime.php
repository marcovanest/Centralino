<?php
namespace Centralino\Utility;

class CentralinoDateTime
{
    const DATE_FORMAT     = 'Y-m-d';
    const TIME_FORMAT     = 'H:i:s';
    const DATETIME_FORMAT = 'Y-m-d H:i:s';
    const TIME_ZONE       = 'UTC';

    private $timezone;

    private function __construct($dateTimeString = null, \DateTimeZone $dateTimeZone = null)
    {
        try {
            $this->datetime = new \DateTime($dateTimeString, $dateTimeZone);
        } catch (\Exception $exception) {
            throw new UtilityException("Invalid date given");
        }
    }

    public static function create($dateTimeString, $dateTimeZone)
    {
        new self($dateTimeString, $dateTimeZone);
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

    private function addAmount($period, $amount, $perioddesignator)
    {
        try {
            $amount = new CentralinoInteger($amount);
            $this->datetime->add(new \DateInterval($period.$amount->get().$perioddesignator));
        } catch (UtilityException $exception) {
            throw new UtilityException('Invalid amount; Not a integer');
        } catch (\Exception $exception) {
            throw new UtilityException('Invalid add amount');
        }
    }

    private function subAmount($period, $amount, $perioddesignator)
    {
        try {
            $amount = new CentralinoInteger($amount);
            $this->datetime->sub(new \DateInterval($period.$amount->get().$perioddesignator));
        } catch (UtilityException $exception) {
            throw new UtilityException('Invalid amount; Not a integer');
        } catch (\Exception $exception) {
            throw new UtilityException('Invalid sub amount');
        }
    }
}
