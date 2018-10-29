<?php

namespace Amber\Config;

use Amber\Collection\Collection;
use Amber\Utils\Implementations\AbstractSingleton;

/**
 * Config provider class.
 *
 * This class stores and shares configurations throughout the components.
 */
class Config extends AbstractSingleton
{

    public static $instance;

    /**
     * Singleton implementation.
     */
    public static function getInstance()
    {
        /* Checks if the Collection is already instantiated. */
        if (!self::$instance instanceof Collection) {
            /* Instantiate the Collection class */
            self::$instance = new Collection();
        }

        return self::$instance;
    }

    public static function set(string $key, $config)
    {
        self::getInstance()->set($key, $config);
    }

    public static function unset(string $key)
    {
        self::getInstance()->delete($key);
    }

    public static function get(string $key, $default = null)
    {
        $config = self::getInstance()->all();

        foreach (explode('.', $key) as $search) {
            if ($config[$search]) {
                $config = $config[$search];
            } else {
                return $default;
            }
        }

        return $config;
    }

    public static function has(string $key)
    {
        return self::getInstance()->has($key);
    }

    public static function all()
    {
        self::getInstance()->all();
    }

    public static function clear()
    {
        self::getInstance()->clear();
    }
}
