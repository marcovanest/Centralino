<?php
namespace Centralino\Utility;

class CentralinoArray implements
    \SeekableIterator,
    \RecursiveIterator,
    \ArrayAccess,
    \Countable,
    \Serializable
{
    private $array;

    private $position;

    private function __construct(array $array)
    {
        if( ! static::isArray($array)) {
            throw new UtilityException('Invalid array');
        }

        $this->array = (array) $array;

        $this->position = 0;
    }

    public static function create($boolean)
    {
        return new self($boolean);
    }

    public function get()
    {
        return (array) $this->array;
    }

    public function keys()
    {
        return array_keys($this->array);
    }

    public function seek($position)
    {
        $this->position = $position;

        if ($this->valid() === false) {
            throw new \OutOfBoundsException();
        }
    }

    public function current()
    {
        return $this->array[$this->key()];
    }

    public function key()
    {
        $keys = $this->keys();

        if (array_key_exists($this->position, $keys) === false) {
            throw new \OutOfBoundsException();
        }

        return $keys[$this->position];
    }

    public function next()
    {
        $this->position++;

        return $this->valid();
    }

    public function prev()
    {
        $this->position--;

        return $this->valid();
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function valid()
    {
        $key = isset(array_keys($this->array)[$this->position]);
        if($key) {
            return isset($this->array[$this->key()]);
        }else {
            return false;
        }
    }

    public function hasChildren()
    {
        return is_array($this->array[$this->key()]);
    }

    public function getChildren()
    {
        if($this->hasChildren()) {
            return new self($this->array[$this->key()]);
        }
        return false;
    }

    public function offsetSet($key, $value)
    {
        $this->array[$key] = $value;
    }

    public function offsetGet($key)
    {
        return $this->array[$key];
    }

    public function offsetExists($key)
    {
        return isset($this->array[$key]);
    }

    public function offsetUnset($key)
    {
       unset($this->array[$key]);
    }

    public function count()
    {
        return count($this->array);
    }

    public function serialize()
    {
        return serialize($this->array);
    }

    public function unserialize($data)
    {
        $this->array = unserialize($data);
    }

    public static function isArray($array)
    {
        return is_array($array);
    }
}
