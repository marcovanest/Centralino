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

    public function getPart(CentralinoInteger $start, CentralinoInteger $length = null)
    {
        $length = ! is_null($length) ? $length->get() : null;

        return mb_substr($this->string, $start->get(), $length, self::CHAR_ENCODING);
    }

    public function countOccurrences($needle)
    {
        $stringNeedle = new self($needle);
        if(empty($stringNeedle->get())) {
            throw new UtilityException("Invalid needle given");
        }

        return mb_substr_count($this->string, $needle, self::CHAR_ENCODING);
    }

    public function firstOccurrence($needle, CentralinoInteger $offset = null)
    {
        $stringNeedle = new self($needle);
        if(empty($stringNeedle->get())) {
            throw new UtilityException("Invalid needle given");
        }

        $offset = ! is_null($offset) ? $offset->get() : null;

        if( ! is_null($offset) && $offset > $this->getLength()) {
            throw new UtilityException("Invalid offset given");
        }

        return mb_strpos($this->string, $needle, $offset, self::CHAR_ENCODING);
    }

    public function LastOccurrence($needle, CentralinoInteger $offset = null)
    {
        $stringNeedle = new self($needle);
        if(empty($stringNeedle->get())) {
            throw new UtilityException("Invalid needle given");
        }

        $offset = ! is_null($offset) ? $offset->get() : null;

        if( ! is_null($offset) && $offset > $this->getLength()) {
            throw new UtilityException("Invalid offset given");
        }

        return mb_strrpos($this->string, $needle, $offset, self::CHAR_ENCODING);
    }

    public function trim($character_mask = " \t\n\r\0\x0B")
    {
        $this->string = trim($this->string, $character_mask);
        return $this;
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