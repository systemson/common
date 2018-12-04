<?php

namespace Amber\Config;

use Amber\Collection\Collection;
use Amber\Filesystem\Filesystem;
use Amber\Utils\Implementations\AbstractWrapper;

/**
 * Config provider class.
 *
 * This class stores and shares configurations throughout the components.
 */
class Config extends AbstractWrapper
{

    protected static $accessor = Collection::class;

    public static function loadFromFile()
    {
        //
    }
}
