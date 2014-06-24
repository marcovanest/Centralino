<?php
namespace Centralino\Utility;

class CentralinoBoolean
{
    private $boolean;

    public function __construct($boolean)
    {
        if( ! static::isBool($boolean)) {
            throw new UtilityException('Invalid float');
        }

        $this->boolean = (bool) $boolean;
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
        return is_bool($boolean);
    }
}