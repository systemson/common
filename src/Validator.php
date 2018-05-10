<?php

namespace Amber\Common;

trait Validator
{
    /**
     * Checks if the specified argument is a valid string.
     *
     * @param string $arg The argument to validate.
     *
     * @throws \InvalidArgumentException
     *
     * @return bool True if the specified argument is valid.
     */
    protected function isString($arg)
    {
        if (!is_string($arg) || $arg === '') {
            throw new \InvalidArgumentException('Argument should be a non empty string.');
        }

        return true;
    }

    /**
     * Checks if the specified argument is a valid string.
     *
     * @param string $arg The argument to validate.
     *
     * @throws \InvalidArgumentException
     *
     * @return bool True if the specified argument is valid.
     */
    protected function isNumeric($arg)
    {
        if (!is_numeric($arg)) {
            throw new \InvalidArgumentException('Argument should be a valid number.');
        }

        return true;
    }

    /**
     * Checks if the specified argument is a valid iterable.
     *
     * @todo After updating to 7.1 validate with is_iterable().
     *
     * @param array|object $arg The argument to validate.
     *
     * @throws \InvalidArgumentException
     *
     * @return bool True if the specified argument is valid.
     */
    protected function isIterable($arg)
    {
        if (is_array($arg) || $arg instanceof \IteratorAggregate) {
            return true;
        }

        throw new \InvalidArgumentException('Argument should be an array or an iterable object.');
    }

    /**
     * Checks if the specified argument is a valid callable.
     *
     * @param mixed $arg The argument to validate.
     *
     * @throws \InvalidArgumentException
     *
     * @return bool True if the specified argument is valid.
     */
    protected function isCallable($arg, $method = null)
    {

        if (is_callable($arg) || is_callable([$arg, $method]) || class_exists($arg)) {
            return true;
        }

        throw new \InvalidArgumentException('Argument should be a valid class, an object or a function.');
    }

    /**
     * Checks for the type of the provided argument.
     *
     * @param mixed $arg The argument to validate.
     *
     * @return bool True if the specified argument is valid.
     */
    protected function getType($arg)
    {
        $type = gettype($arg);

        try {
            if ($type == 'string' && $this->isCallable($arg)) {
                return 'class';
            }
        } catch (\InvalidArgumentException $e) {
            return $type;
        }

        return $type;
    }

    /**
     * Checks if two provided arguments are of the same type.
     *
     * @param mixed $arg1 The first argument to validate.
     * @param mixed $arg2 The second argument to validate.
     *
     * @return bool True if the specified arguments are of the same type.
     */
    protected function sameType($arg1, $arg2)
    {
        return $this->getType($arg1) === $this->getType($arg2);
    }
}

