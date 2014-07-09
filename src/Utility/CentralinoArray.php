<?php
namespace Centralino\Utility;

class CentralinoArray extends UtilityAbstract implements
    \SeekableIterator,
    \RecursiveIterator,
    \ArrayAccess,
    \Countable,
    \Serializable,
    UtilityInterface
{
    private $array;

    private $position;

    public function __construct(array $array)
    {
        if (! $this->isArray($array)) {
            $this->throwException('Invalid array');
        }

        $this->array = (array) $array;

        $this->position = 0;
    }

    public function get()
    {
        return (array) $this->array;
    }

    public function keys()
    {
        return array_keys($this->array);
    }

    public function in($needle)
    {
        return in_array($needle, $this->array, true);
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

        $keyExists = new CentralinoBoolean(array_key_exists($this->position, $keys));

        if ($keyExists->isFalse()) {
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
        $key = new CentralinoBoolean(isset(array_keys($this->array)[$this->position]));
        if ($key->isFalse()) {
            return false;
        }

        return isset($this->array[$this->key()]);
    }

    public function hasChildren()
    {
        return is_array($this->array[$this->key()]);
    }

    public function getChildren()
    {
        if ($this->hasChildren()) {
            return new CentralinoArray($this->array[$this->key()]);
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
