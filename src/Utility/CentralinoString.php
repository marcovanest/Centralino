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

    public function getPart($start, $length = null)
    {
        return mb_substr($this->string, $start, $length, self::CHAR_ENCODING);
    }

    public function countOccurrences($needle)
    {
        $stringNeedle = new self($needle);
        if(empty($stringNeedle->get())) {
            throw new UtilityException("Invalid needle given");
        }

        return mb_substr_count($this->string, $needle, self::CHAR_ENCODING);
    }

    public function firstOccurrence($needle, $offset = 0)
    {
        $stringNeedle = new self($needle);
        if(empty($stringNeedle->get())) {
            throw new UtilityException("Invalid needle given");
        }

        if($offset > $this->getLength()) {
            throw new UtilityException("Invalid offset given");
        }

        return mb_strpos($this->string, $needle, $offset, self::CHAR_ENCODING);
    }

    public function LastOccurrence($needle, $offset = 0)
    {
        $stringNeedle = new self($needle);
        if(empty($stringNeedle->get())) {
            throw new UtilityException("Invalid needle given");
        }

        if($offset > $this->getLength()) {
            throw new UtilityException("Invalid offset given");
        }

        return mb_strrpos($this->string, $needle, $offset, self::CHAR_ENCODING);
    }

    public function isUTF8()
    {
        return mb_check_encoding($this->string, self::CHAR_ENCODING);
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