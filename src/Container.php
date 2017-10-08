<?php

namespace OtherCode\Container;


/**
 * Class Container
 * @package OtherCode\Container
 */
class Container implements \ArrayAccess, \Countable, \IteratorAggregate, \Psr\Container\ContainerInterface
{
    /**
     * Container
     * @var array
     */
    private $container = array();

    /**
     * Container constructor.
     * @param array $values
     */
    public function __construct(array $values = array())
    {
        foreach ($values as $id => $value) {
            $this->__set($id, $value);
        }
    }

    /**
     * Return true if the identifier exists, false if not
     * @param string $id
     * @return bool
     */
    public function has($id)
    {
        return $this->__isset($id);
    }

    /**
     * Return the list of keys
     * @return array
     */
    public function keys()
    {
        return array_keys($this->container);
    }

    /**
     * Return the required value with the given id
     * @param $id
     * @return mixed|null
     */
    public function get($id)
    {
        return $this->__get($id);
    }

    /**
     * Set value with a id
     * @param $id
     * @param $value
     */
    public function set($id, $value)
    {
        $this->__set($id, $value);
    }

    /**
     * Return the required value with the given id
     * @param string $id
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @return mixed
     */
    public function __get($id)
    {
        if (!isset($this->container[strtolower($id)])) {
            throw new \OtherCode\Container\Exceptions\NotFoundException(sprintf('No entries found with id "%s".', $id));
        }

        return $this->container[strtolower($id)];
    }

    /**
     * Set value with a id
     * @param string $id
     * @param mixed $value
     */
    public function __set($id, $value)
    {
        $this->container[strtolower($id)] = $value;
    }

    /**
     * Unset an element from the container
     * @param string $id
     */
    public function __unset($id)
    {
        unset($this->container[strtolower($id)]);
    }

    /**
     * Check if a element exists or not in the container
     * @param string $id
     * @return boolean
     */
    public function __isset($id)
    {
        return isset($this->container[strtolower($id)]);
    }

    /**
     * Return the requested entry from the container
     * @param string $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->__get($offset);
    }

    /**
     * Set a given entry in the container
     * @param string $offset
     * @param string $value
     */
    public function offsetSet($offset, $value)
    {
        $this->__set($offset, $value);
    }

    /**
     * Check if a entry exists or not in the container
     * @param string $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $this->__isset($offset);
    }

    /**
     * Unset an element from the container
     * @param string $offset
     */
    public function offsetUnset($offset)
    {
        $this->__unset($offset);
    }

    /**
     * Return an ArrayIterator for the container.
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->container);
    }

    /**
     * Return the number of elements in the container
     * @return int
     */
    public function count()
    {
        return count($this->container);
    }
}