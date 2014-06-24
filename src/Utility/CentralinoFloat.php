<?php
namespace Centralino\Utility;

class CentralinoFloat
{
    CONST PRECISION = 2;

    private $float;

    public function __construct($float)
    {
        if( ! static::isFloat($float)) {
            throw new UtilityException('Invalid float');
        }

        $this->float = (float) $float;
    }

    public function get($precision = self::PRECISION)
    {
        return (float) round($this->float, $precision);
    }

    public function add($add)
    {
        if(static::isFloat($add) || CentralinoInteger::isInteger($add)) {
            $this->float = $this->float + $add;
            return true;
        }
        return false;
    }

    public function sub($sub)
    {
        if(static::isFloat($sub) || CentralinoInteger::isInteger($sub)) {
            $this->float = $this->float - $sub;
            return true;
        }
        return false;
    }

    public function div($div)
    {
        if(static::isFloat($div) || CentralinoInteger::isInteger($div)) {
            $this->float = $this->float / $div;
            return true;
        }
        return false;
    }

    public function mul($mul)
    {
        if(static::isFloat($mul) || CentralinoInteger::isInteger($mul)) {
            $this->float = $this->float * $mul;
            return true;
        }
        return false;
    }

    public function mod($modulo)
    {
        if(static::isFloat($modulo) || CentralinoInteger::isInteger($add)) {
            $this->float = $this->float % $modulo;
            return true;
        }
        return false;
    }

    public function pow($pow)
    {
        if(static::isFloat($pow) || CentralinoInteger::isInteger($pow)) {
            $this->float = pow($this->float, $pow);
            return true;
        }
        return false;
    }

    public function sqrt()
    {
        return sqrt($this->float);
    }

    public function isPositive()
    {
        return $this->float >= 0;
    }

    public function isNegative()
    {
        return $this->float < 0;
    }

    public static function isFloat($float)
    {
        return is_float($float);
    }
}