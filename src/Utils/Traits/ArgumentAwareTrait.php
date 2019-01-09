<?php

namespace Amber\Utils\Traits;

trait ArgumentAwareTrait
{
    /**
     * @var array The constructor arguments.
     */
    private static $arguments = [];

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
}
