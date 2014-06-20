<?php
namespace Centralino\Utility;

class CentralinoArray implements
    \SeekableIterator,
    \ArrayAccess,
    \Countable,
    \Serializable
{
    private $array;

    private $position;

    public function __construct(array $array)
    {
        if( ! $this->isArray($array)) {
            throw new UtilityException('Invalid array');
        }

        $this->array = (array) $array;
    }

    public function get()
    {
        return (array) $this->array;
    }

    public function keys()
    {
        return  array_keys($this->array);
    }

    private function isArray($array)
    {
        return is_array($array);
    }

    public function seek($position)
    {
        if ($position > count($this->array)) {
            throw new OutOfBoundsException();
        }

        $this->rewind();

        for ($i = 0; $i < $position; $i++) {
            $this->next();
        }
    }

    public function current()
    {
        return current($this->array);
    }

    public function key()
    {
        return key($this->array);
    }

    public function next()
    {
        return next($this->array);
    }

    public function rewind()
    {
        reset($this->array);
    }

    public function valid()
    {
        return (current($this->array) !== false);
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
}