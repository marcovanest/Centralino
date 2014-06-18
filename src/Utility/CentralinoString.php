<?php
namespace Centralino\Utility;

class CentralinoString
{
    CONST CHAR_ENCODING = 'UTF-8';

    private $string;

    public function __construct($string)
    {
        $this->string = $string;

        if( ! $this->isValidString()) {
            throw new UtilityException("Invalid string given");
        }
    }

    public function __toString()
    {
        return $this->string;
    }

    public function get()
    {
        return $this->string;
    }

    public function getLength()
    {
        return mb_strlen($this->string, self::CHAR_ENCODING);
    }

    public function isUTF8()
    {
        return mb_check_encoding($this->string, self::CHAR_ENCODING);
    }

    public static function isString($string)
    {
        return is_string($string);
    }

    private function isValidString()
    {
        if( ! is_string($this->string) ||
            ! $this->isUTF8() ||
            ! mb_detect_encoding($this->string, self::CHAR_ENCODING, true)
        ) {
            return false;
        }

        return true;
    }
}