<?php

namespace Amber\Utils\Implementations;

/**
 * Implementation of a singleton class.
 */
abstract class AbstractSingleton
{
    /**
     * @var static The instance of the class.
     */
    protected static $instance;

    /**
     * Prevents instantiation.
     */
    final public function __construct()
    {
        throw new \Exception("Cannot instantiate \"{__CLASS__}\"");
    }

    /**
     * Prevents clonation.
     */
    final protected function __clone()
    {
        throw new \Exception("Cannot clon an instance of \"{__CLASS__}\"");
    }

    /**
     * Prevents unserialization.
     */
    final public function __wakeup()
    {
        throw new \Exception("Cannot unserialize \"{__CLASS__}\"");
    }

    /**
     * Returns the instance of the class.
     */
    abstract public static function getInstance();
}
