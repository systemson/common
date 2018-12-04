<?php

namespace Amber\Utils\Implementations;

use Amber\Utils\Traits\SingletonTrait;
use Amber\Reflector\Reflector;
use Amber\Utils\Contracts\ArgumentAwareInterface;

/**
 * Implementation of a static wrapper class.
 */
abstract class AbstractWrapper extends AbstractSingleton
{
    /**
     * @var The class accessor.
     */
    protected static $accessor;

    /**
     * Sets the class accesor.
     *
     * @var string $class The class accesor.
     *
     * @return void
     */
    public static function setAccessor(string $accessor): void
    {
        static::$accessor = $accessor;
    }

    /**
     * Gets the class accesor.
     *
     * @return mixed The class accesor
     */
    public static function getAccessor(): string
    {
        return static::$accessor;
    }

    /**
     * Returns the instance of the class.
     */
    public static function getInstance()
    {
        $accesor = static::getAccessor();

        $args = (static::class instanceof ArgumentAwareInterface) ? static::getArguments() : [];

        if (!static::$instance instanceof $accesor) {
            static::$instance = Reflector::instantiate($accesor, $args);
        }

        return static::$instance;
    }
}
