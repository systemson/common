<?php

namespace Amber\Utils\Traits;

trait SingletonTrait
{
    /**
     * @var mixed The instance of the accessor.
     */
    protected static $instance;

    /**
     * To publicly expose a method it must be public or protected.
     *
     * @var array The method(s) that should be publicly exposed. An empty array means all.
     */
    protected static $passthru = [];

    /**
     * @var array The dinamically added method(s).
     */
    protected static $macros = [];
}
