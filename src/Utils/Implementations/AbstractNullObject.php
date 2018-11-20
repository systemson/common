<?php

namespace Amber\Utils\Implementations;

use ArrayAccess;

/**
 * Abstract null object.
 *
 * @todo MUST implement array access, json serializable, serializable.
 */
abstract class AbstractNullObject implements ArrayAccess
{
    public function __set($key, $value)
    {
        //
    }

    public function __get($value)
    {
        return null;
    }

    public function __invoke()
    {
        return null;
    }

    public function isNull()
    {
        return true;
    }

    public function isEmpty()
    {
        return true;
    }

    public function __toString()
    {
        return '';
    }

    public function offsetExists($offset): boolean
    {
        return false;
    }

    public function offsetGet($offset)
    {
        return null;
    }

    public function offsetSet($offset, $value)
    {
        return;
    }

    public function offsetUnset($offset)
    {
        return;
    }
}
