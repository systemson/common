<?php

namespace Tests\Example;

use Amber\Utils\Implementations\AbstractWrapper;

class ConcreteWrapper extends AbstractWrapper
{
    /**
     * @var The class accessor.
     */
    protected static $accessor = SymfonyResponse::class;

    /**
     * @var self The instance of the class.
     */
    protected static $instance;

    /**
     * To expose publicy a method, the method should be declared protected.
     *
     * @var array The method(s) that should be publicly exposed.
     */
    protected static $passthru = [
        'getId',
    ];

    public static function setArguments(...$args): void
    {
        //
    }

    public static function getArguments(): array
    {
        return [];
    }
}
