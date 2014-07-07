<?php
namespace Centralino\Utility;

class CentralinoInteger
{
    private $int;

    public function __construct($int)
    {
        if (! static::isInteger($int)) {
            throw new UtilityException('Invalid integer');
        }

        $this->int = (int) $int;
    }

    public function get()
    {
        return (int) $this->int;
    }

    public function add($add)
    {
        if (static::isInteger($add)) {
            $this->int = ($this->int + $add);
            return true;
        }
        return false;
    }

    public function sub($sub)
    {
        if (static::isInteger($sub)) {
            $this->int = ($this->int - $sub);
            return true;
        }
        return false;
    }

    public function div($divide)
    {
        if (static::isInteger($divide)) {
            $this->int = ($this->int / $divide);
            return true;
        }
        return false;
    }

    public function mul($multi)
    {
        if (static::isInteger($multi)) {
            $this->int = ($this->int * $multi);
            return true;
        }
        return false;
    }

    public function mod($modulo)
    {
        if (static::isInteger($modulo)) {
            return new self( ($this->int % $modulo) );
        }
        return false;
    }

    public function pow($pow)
    {
        if (static::isInteger($pow)) {
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
        return new self( abs($this->int) );
    }

    public function sqrt()
    {
        if ($this->isPositive()) {
            return new CentralinoFloat(sqrt($this->int));
        }
        return false;
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
