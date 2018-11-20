<?php

namespace Amber\Utils\Implementations;

use Amber\Utils\Traits\SingletonTrait;

/**
 * Implementation of a singleton class.
 */
abstract class AbstractSingleton
{
    use SingletonTrait;

    /**
     * Prevents instantiation.
     */
    final private function __construct()
    {
    }

    /**
     * Prevents clonation.
     */
    final public function __clone()
    {
        throw new \Exception('Cannot clone "[' . get_called_class() . ']"');
    }

    /**
     * Prevents unserialization.
     */
    final public function __wakeup()
    {
        throw new \Exception('Cannot unserialize ["' . get_called_class() . '"]');
    }

    /**
     * Returns the instance of the class.
     */
    abstract public static function getInstance();
}
