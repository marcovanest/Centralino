<?php
namespace Centralino\Utility;

class CentralinoInteger
{
    private $int;

    public function __construct($int)
    {
        if( ! $this->isInteger($int)) {
            throw new UtilityException('Invalid integer');
        }

        $this->int = (int) $int;
    }

    public function get()
    {
        return (int) $this->int;
    }

    public function isPositive()
    {
        return $this->int >= 0;
    }

    public function isNegative()
    {
        return $this->int < 0;
    }

    private function isInteger($int)
    {
        return is_integer($int);
    }
}