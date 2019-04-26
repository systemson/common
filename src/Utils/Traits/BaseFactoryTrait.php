<?php

namespace Amber\Utils\Traits;

use ReflectionClass;

trait BaseFactoryTrait
{
    /**
     * Returns a new instance of the specified class.
     *
     * @param string   $class The class name.
     * @param iterable $args  The arguments for the class constructor.
     *
     * @return mixed The class instance.
     */
    final protected static function make(string $class, array $args = [])
    {
        return (new ReflectionClass($class))->newInstanceArgs($args);
    }
}
