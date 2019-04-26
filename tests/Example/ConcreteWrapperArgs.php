<?php

namespace Tests\Example;

use Amber\Utils\Implementations\AbstractWrapper;

class ConcreteWrapperArgs extends AbstractWrapper
{
    /**
     * @var The class accessor.
     */
    protected static $accessor = Controller::class;

    /**
     * @var self The instance of the class.
     */
    protected static $instance;

    /**
     * @var array The arguments for the class constructor.
     */
    public static $arguments = [];

    /**
     * To expose publicy a method, the method should be declared protected.
     *
     * @var array The method(s) that should be publicly exposed.
     */
    protected static $passthru = [
        'getView',
        'getModel',
    ];

    /**
     * Runs after the class constructor.
     *
     * @return void
     */
    public static function beforeConstruct(): void
    {
        static::setArguments(new View(), new Model());
    }
}
