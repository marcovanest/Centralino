<?php
namespace Centralino\Utility;

class CentralinoBoolean extends UtilityAbstract implements UtilityInterface
{
    private $boolean;

    public function __construct($boolean)
    {
        if (! $this->isBool($boolean)) {
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
        return is_bool($boolean);
    }
}
