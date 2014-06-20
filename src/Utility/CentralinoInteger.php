<?php
namespace Centralino\Utility;

class CentralinoInteger
{
    private $int;

    public function __construct($int)
    {
        if( ! self::isInteger($int)) {
            throw new UtilityException('Invalid integer');
        }

        $this->int = $int;
    }

    public function get()
    {
        return $this->int;
    }

    public function __toString()
    {
        return (string) $this->int;
    }

    public function isPositive()
    {
        return $this->int >= 0;
    }

    public function isNegative()
    {
        return $this->int < 0;
    }

    public static function isInteger($int)
    {
        return is_integer($int);
    }

}