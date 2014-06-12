<?php
namespace Centralino\Utility;

class CentralinoString
{
    private $string;

    public function __construct($string)
    {
        if( ! is_string($string)) {
             throw new UtilityException("Invalid string given");
        }

        $this->string = $string;
    }

    public function get()
    {
        return $this->string;
    }

    public static function isString($string)
    {
        return is_string($string);
    }

    public function __toString()
    {
        return $this->string;
    }

}