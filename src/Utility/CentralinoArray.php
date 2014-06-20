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
        return array_keys($this->array);
    }

    public function seek($position)
    {
        if ($position > $this->count()-1) {
            throw new OutOfBoundsException();
        }

        $this->position = $position;
    }

    public function current()
    {
        return $this->array[$this->key()];
    }

    public function key()
    {
        return array_keys($this->array)[$this->position];
    }

    public function next()
    {
        $this->position++;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function valid()
    {
        return isset($this->array[$this->key()]);
    }

    public function hasChildren()
    {
        return is_array($this->array[$this->key()]);
    }

    public function getChildren()
    {
        // echo '<pre>';
        // print_r($this->_data[$this->_position]);
        // echo '</pre>';
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

    private function isArray($array)
    {
        return is_array($array);
    }
}