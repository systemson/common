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
    public function __set($name, $value)
    {
        //
    }

    public function __isset($name)
    {
        return false;
    }

    public function __unset($name)
    {
        //;
    }

    public function __get($name)
    {
        return null;
    }

    public function __invoke()
    {
        return null;
    }

    public function isNull(): bool
    {
        return true;
    }

    public function isEmpty(): bool
    {
        return true;
    }

    public function toArray(): array
    {
        return [];
    }

    public function __toString()
    {
        return '';
    }

    public function offsetExists($offset)
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
