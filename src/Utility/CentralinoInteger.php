<?php
namespace Centralino\Utility;

class CentralinoInteger extends UtilityAbstract implements UtilityInterface
{
    private $int;

    public function __construct($int)
    {
        if (! $this->isInteger($int)) {
            $this->throwException('Invalid integer');
        }

        $this->int = (int) $int;
    }

    public function get()
    {
        return (int) $this->int;
    }

    public function add($add)
    {
        if ($this->isValidModifier($add)) {
            $this->int = ($this->int + $add);
            return true;
        }
        return false;
    }

    public function sub($sub)
    {
        if ($this->isValidModifier($sub)) {
            $this->int = ($this->int - $sub);
            return true;
        }
        return false;
    }

    public function div($divide)
    {
        if ($this->isValidModifier($divide)) {
            $this->int = ($this->int / $divide);
            return true;
        }
        return false;
    }

    public function mul($multi)
    {
        if ($this->isInteger($multi)) {
            $this->int = ($this->int * $multi);
            return true;
        }
        return false;
    }

    public function mod($modulo)
    {
        if ($this->isValidModifier($modulo)) {
            return ($this->int % $modulo);
        }
        return false;
    }

    public function pow($pow)
    {
        if ($this->isValidModifier($pow)) {
            $result = pow($this->int, $pow);

            if ($this->isInteger($result)) {
                $this->int = $result;
                return true;
            } elseif (CentralinoFloat::isFloat($result)) {
                return new CentralinoFloat($result);
            }
        }
        return false;
    }

    public function abs()
    {
        return abs($this->int);
    }

    public function sqrt()
    {
        if ($this->isNegative()) {
            return false;
        }

        return sqrt($this->int);
    }

    public function isPositive()
    {
        return $this->int >= 0;
    }

    public function isNegative()
    {
        return $this->int < 0;
    }

    private function isValidModifier($modifier)
    {
        return $this->isInteger($modifier);
    }

    public static function isInteger($int)
    {
        return is_integer($int);
    }
}
