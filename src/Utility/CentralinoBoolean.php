<?php
namespace Centralino\Utility;

class CentralinoBoolean
{
    private $boolean;

    public function __construct($boolean)
    {
        if( ! static::isBool($boolean)) {
            throw new UtilityException('Invalid boolean');
        }

        $this->boolean = (bool) $boolean;
    }

    public function get()
    {
        return (bool) $this->boolean;
    }

    public function isFalse()
    {
        return $this->boolean === false;
    }

    public function isTrue()
    {
        return $this->boolean === true;
    }

    public static function isBool($boolean)
    {
        if(CentralinoInteger::isInteger($boolean)) {
            $integer = new CentralinoInteger($boolean);
            if($integer->isNegative()) {
                return false;
            }
        }

        if(CentralinoFloat::isFloat($boolean)) {
            $float = new CentralinoFloat($boolean);
            if($float->isNegative()) {
                return false;
            }
        }

        return is_bool((bool) $boolean);
    }
}