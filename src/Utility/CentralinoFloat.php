<?php
namespace Centralino\Utility;

class CentralinoFloat extends UtilityAbstract implements UtilityInterface
{
    const PRECISION = 2;

    private $float;

    public function __construct($float)
    {
        if (! $this->isFloat($float)) {
            $this->throwException('Invalid float');
        }

        $this->float = (float) $float;
    }

    public function get($precision = self::PRECISION)
    {
        return (float) round($this->float, $precision);
    }

    public function add($add)
    {
        if ($this->isValidModifier($add)) {
            $this->float = $this->float + $add;
            return true;
        }
        return false;
    }

    public function sub($sub)
    {
        if ($this->isValidModifier($sub)) {
            $this->float = $this->float - $sub;
            return true;
        }
        return false;
    }

    public function div($div)
    {
        if ((int) $div === 0) {
            $this->throwException('Divide by zero');
        }

        if ($this->isValidModifier($div)) {
            $this->float = $this->float / $div;
            return true;
        }
        return false;
    }

    public function mul($mul)
    {
        if ($this->isValidModifier($mul)) {
            $this->float = $this->float * $mul;
            return true;
        }
        return false;
    }

    public function mod($modulo)
    {
        if ($modulo === 0) {
            $this->throwException('Divide by zero');
        }

        if ($this->isValidModifier($modulo)) {
            return fmod($this->float, $modulo);
        }
        return false;
    }

    public function pow($pow)
    {
        if ($this->isValidModifier($pow)) {
            $result = pow($this->float, $pow);

            if ($this->isFloat($result)) {
                $this->float = $result;
                return true;
            }
        }
        return false;
    }

    public function abs()
    {
        return abs($this->float);
    }

    public function sqrt()
    {
        if ($this->isPositive()) {
            return sqrt($this->float);
        }
        return false;
    }

    public function isPositive()
    {
        return $this->float >= 0;
    }

    public function isNegative()
    {
        return $this->float < 0;
    }

    private function isValidModifier($modifier)
    {
        $valid = $this->isFloat($modifier) || CentralinoInteger::isInteger($modifier);
        return $valid;
    }

    public static function isFloat($float)
    {
        return is_float($float);
    }
}
