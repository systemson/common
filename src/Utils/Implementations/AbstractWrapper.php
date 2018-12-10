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

            $implements = class_implements(static::class);
            $args = in_array('Amber\Utils\Contracts\ArgumentAwareInterface', $implements) ? static::getArguments() : [];

            static::$instance = Reflector::instantiate($accesor, $args);

            static::afterConstruct();
        }

        return static::$instance;
    }
}
