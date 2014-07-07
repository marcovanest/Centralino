<?php
namespace Centralino\Utility;

class CentralinoString extends UtilityAbstract implements UtilityInterface
{
    const CHAR_ENCODING = 'UTF-8';

    private $string;

    public function __construct($string)
    {
        if (! $this->isString($string)) {
            $this->throwException('Invalid string');
        }

        $this->string = $string;
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
        if ($this->isEmptyString($needle) === true || $this->isString($needle) === false) {
            $this->throwException('Invalid needle given');
        }

        return mb_substr_count($this->string, $needle, self::CHAR_ENCODING);
    }

    public function firstOccurrence($needle, CentralinoInteger $offset = null)
    {
        if ($this->isEmptyString($needle) === true || $this->isString($needle) === false) {
            $this->throwException('Invalid needle given');
        }

        $offset = ! is_null($offset) ? $offset->get() : null;

        if (! is_null($offset) && $offset > $this->getLength()) {
            $this->throwException('Invalid offset given');
        }

        return mb_strpos($this->string, $needle, $offset, self::CHAR_ENCODING);
    }

    public function lastOccurrence($needle, CentralinoInteger $offset = null)
    {
        if ($this->isEmptyString($needle) === true || $this->isString($needle) === false) {
            $this->throwException('Invalid needle given');
        }

        $offset = ! is_null($offset) ? $offset->get() : null;

        if (! is_null($offset) && $offset > $this->getLength()) {
            $this->throwException('Invalid offset given');
        }

        return mb_strrpos($this->string, $needle, $offset, self::CHAR_ENCODING);
    }

    public function trim($characterMask = " \t\n\r\0\x0B")
    {
        $this->string = trim($this->string, $characterMask);
        return $this;
    }

    private static function isEmptyString($string)
    {
        return $string === "";
    }

    public static function isString($string)
    {
        if (! is_string($string) ||
            ! mb_check_encoding($string, self::CHAR_ENCODING) ||
            ! mb_detect_encoding($string, self::CHAR_ENCODING, true)
        ) {
            return false;
        }

        return true;
    }
}
