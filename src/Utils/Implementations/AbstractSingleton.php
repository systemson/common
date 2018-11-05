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
    final private function __construct()
    {
    }

    /**
     * Prevents clonation.
     */
    final private function __clone()
    {
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
