<?php

namespace Amber\Utils\Traits;

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
    final protected static function make(string $class, iterable $args = [])
    {
        $instance = (new ReflectionClass($class))->newInstanceArgs($args);
    }
}
