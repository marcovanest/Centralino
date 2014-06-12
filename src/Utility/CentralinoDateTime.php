<?php
namespace Centralino\Utility;

class CentralinoDateTime
{
    private $date;

    public function __construct($date = null)
    {
        try{
            $this->date = new \DateTime($date);
        }catch(\Exception $exception) {
            throw new UtilityException("Invalid date given");
        }
    }

    public function addSeconds($seconds)
    {
        $this->addAmount('PT', $seconds, 'S');
    }

    public function addMinutes($minutes)
    {
        $this->addAmount('PT', $minutes, 'M');
    }

    public function addHours($hours)
    {
        $this->addAmount('PT', $hours, 'H');
    }

    public function addDays($days)
    {
        $this->addAmount('P', $days, 'D');
    }

    public function addMonths($months)
    {
        $this->addAmount('P', $months, 'M');
    }

    public function addYears($years)
    {
        $this->addAmount('P', $years, 'Y');
    }

    private function addAmount($period, $amount, $perioddesignator)
    {
        try{
            $amount = new CentralinoInteger($amount);
            $this->date->add(new \DateInterval($period.$amount->get().$perioddesignator));
        }catch(UtilityException $exception) {
           throw new UtilityException('Invalid amount; Not a integer');
        }catch(\Exception $exception) {
           throw new UtilityException('Invalid add amount');
        }
    }
}