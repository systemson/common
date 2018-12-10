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
     * @var array The constructor arguments.
     */
    protected static $arguments = [];

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
     * Sets the class constructor arguments.
     *
     * @var mixed $args The arguments for the class constructor.
     *
     * @return void
     */
    public static function setArguments(...$args): void
    {
        static::$arguments = $args;
    }

    /**
     * Gets the class constructor arguments.
     *
     * @return array The arguments for the class constructor.
     */
    public static function getArguments(): array
    {
        return static::$arguments;
    }

    /**
     * Runs before the class constructor.
     *
     * @return void
     */
    public static function beforeConstruct(): void
    {
        //
    }

    /**
     * Runs after the class constructor.
     *
     * @return void
     */
    public static function afterConstruct(): void
    {
        //
    }

    /**
     * Returns the instance of the class.
     */
    public static function getInstance()
    {
        $accesor = static::getAccessor();

        if (!static::$instance instanceof $accesor) {
            static::beforeConstruct();
            static::$instance = Reflector::instantiate($accesor, static::getArguments());
            static::afterConstruct();
        }

        return static::$instance;
    }
}
