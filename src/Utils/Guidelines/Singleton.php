<?php

namespace Amber\Utils\Guidelines;

abstract class Singleton
{
    /**
     * @var static The instance of the class.
     */
    protected static $instance;

    /**
     * Prevents instantiation.
     *
     * @todo MUST return an exception on instantiation.
     */
    final protected function __construct()
    {
        //
    }

    /**
     * Prevents clonation.
     *
     * @todo MUST return an exception on clonation.
     */
    final protected function __clone()
    {
        //
    }

    /**
     * Prevents unserialization.
     */
    final public function __wakeup()
    {
        throw new Exception("Cannot unserialize {__CLASS__}");
    }

    /**
     * Returns the instance of the class.
     */
    abstract public static function getInstance();
}
