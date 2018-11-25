<?php

namespace Amber\Utils\Implementations;

use Amber\Utils\Traits\SingletonTrait;

/**
 * Implementation of a singleton class.
 */
abstract class AbstractSingleton
{
    /**
     * @var self The instance of the class.
     */
    private static $instance;

    /**
     * To expose publicy a method it should be declared protected.
     *
     * @var array The method(s) that should be publicly exposed.
     */
    protected static $passthru = [];

    /**
     * Prevents instantiation.
     */
    final protected function __construct()
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
    public static function getInstance()
    {
        if (!self::$instance instanceof static) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    public static function __callStatic($method, $args = [])
    {
        if (array_search($method, static::$passthru) !== false) {
            return call_user_func_array([self::getInstance(), $method], $args);
        }

        if (method_exists(static::class, $method)) {
            throw new \Exception("Non-static method " . get_called_class() . "::{$method}() should not be called statically");
        }

        throw new \Error("Call to undefined method get_called_class()" . "::{$method}()");
        
    }
}
