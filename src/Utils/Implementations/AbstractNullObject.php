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
