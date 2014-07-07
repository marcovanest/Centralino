<?php
namespace Centralino\Utility;

class CentralinoBoolean
{
    private $boolean;

    private function __construct($boolean)
    {
        if ( ! static::isBool($boolean)) {
            throw new UtilityException('Invalid boolean');
        }

        $this->boolean = (bool) $boolean;
    }

    public static function create($boolean)
    {
        return new self($boolean);
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
        return is_bool($boolean);
    }
}
