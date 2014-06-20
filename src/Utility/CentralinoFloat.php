<?php
namespace Centralino\Utility;

class CentralinoFloat
{
    private $float;

    public function __construct($float)
    {
        if( ! $this->isFloat($float)) {
            throw new UtilityException('Invalid float');
        }

        $this->float = (float) $float;
    }

    public function get()
    {
        return (float) $this->float;
    }

    public function isPositive()
    {
        return $this->float >= 0;
    }

    public function isNegative()
    {
        return $this->float < 0;
    }

    private function isFloat($float)
    {
        return is_float($float);
    }
}