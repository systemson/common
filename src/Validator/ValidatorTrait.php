<?php

namespace Amber\Validator;

/**
 * @todo SHOULD validate for the content of an array or array accesible object.
 *       Example: isStrArray(), isIntArray(), isBoolArray()...
 *
 * @deprecated This class MUST be renamed to ValidatorTrait, and a Validator class should be created.
 *             The Validator class MUST handle statically all the validations.
 */
trait ValidatorTrait
{
    /**
     * Checks if the specified argument is a valid string.
     *
     * @param string $arg The argument to validate.
     *
     * @return bool True if the specified argument is valid. False if it does not.
     */
    protected function isString(...$args)
    {
        foreach ($args as $arg) {
            if (!is_string($arg) || $arg === '') {
                return false;
            }
        }

        return true;
    }

    /**
     * Checks if the specified argument is a valid number.
     *
     * @param string $arg The argument to validate.
     *
     * @return bool True if the specified argument is valid. False if it does not.
     */
    protected function isNumeric(...$args)
    {
        foreach ($args as $arg) {
            if (!is_numeric($arg)) {
                return false;
            }
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
     * @return bool True if the specified argument is valid. False if it does not.
     */
    protected function isIterable(...$args)
    {
        foreach ($args as $arg) {
            if (!is_array($arg) && !$arg instanceof \IteratorAggregate) {
                return false;
            }
        }

        return true;
    }

    /**
     * Checks if the specified argument is a valid callable.
     *
     * @param mixed $arg The argument to validate.
     *
     * @return bool True if the specified argument is valid. False if it does not.
     */
    protected function isCallable($arg, $method = null)
    {
        if (is_callable($arg) || is_callable([$arg, $method]) || $this->isClass($arg)) {
            return true;
        }

        return false;
    }

    /**
     * Checks if the specified argument is a valid class.
     *
     * @param mixed $arg The argument to validate.
     *
     * @return bool True if the specified argument is valid. False if it does not.
     */
    protected function isClass(...$args)
    {
        foreach ($args as $arg) {
            if (!$this->isString($arg) || (!class_exists($arg) && !interface_exists($arg))) {
                return false;
            }
        }

        return true;
    }

    /**
     * Returns the type of the provided argument.
     *
     * @param mixed $arg The argument to validate.
     *
     * @return bool True if the specified argument is valid. False if it does not.
     */
    protected function getType($arg)
    {
        $type = gettype($arg);

        if ($this->isClass($arg)) {
            return 'class';
        }

        return $type;
    }

    /**
     * Checks if two provided arguments are of the same type.
     *
     * @param mixed $arg1 The first argument to validate.
     * @param mixed $arg2 The second argument to validate.
     *
     * @return bool True if the specified arguments are of the same type. False if they do not.
     */
    protected function sameType($arg1, $arg2)
    {
        return $this->getType($arg1) === $this->getType($arg2);
    }
}
