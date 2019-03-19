<?php

namespace Amber\Config;

use Amber\Collection\Collection;
use Amber\Filesystem\Filesystem;
use Amber\Utils\Implementations\AbstractWrapper;
use Amber\Utils\Traits\ArgumentAwareTrait;
use Amber\Utils\Contracts\ArgumentAwareInterface;

/**
 * Config provider class.
 *
 * This class stores and shares configurations throughout the components.
 */
class Config extends AbstractWrapper implements ArgumentAwareInterface
{
    use ArgumentAwareTrait;

    /**
     * @var The class accessor.
     */
    protected static $accessor = Collection::class;

    /**
     * @var self The instance of the class.
     */
    protected static $instance;

    /**
     * Runs before the class constructor.
     *
     * @return void
     */
    public static function beforeConstruct(): void
    {
        static::setArguments([], true);
    }

    public static function loadFromFile()
    {
        //
    }
}
