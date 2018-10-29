<?php

namespace Amber\Utils\Implementations;

/**
 * Implementation of a singleton class.
 */
abstract class AbstractSingleton
{
    /**
     * Prevents instantiation.
     */
    final public function __construct()
    {
        throw new \Exception('Cannot instantiate "' . get_called_class() . '"');
    }

    /**
     * Prevents clonation.
     */
    final public function __clone()
    {
        throw new \Exception('Cannot clon an instance of "' . get_called_class() . '"');
    }

    /**
     * Prevents unserialization.
     */
    final public function __wakeup()
    {
        throw new \Exception('Cannot unserialize "' . get_called_class() . '"');
    }

    /**
     * Returns the instance of the class.
     */
    abstract public static function getInstance();
}
