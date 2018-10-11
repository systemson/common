<?php

namespace Amber\Config;

use Amber\Collection\Collection;
use Amber\Utils\Guidelines\Singleton;

/**
 * Config provider class.
 *
 * This class stores and shares configurations throughout all the components.
 */
class Config extends Singleton
{
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

    public static function set($config)
    {
        foreach ($config as $key => $value) {
             self::getInstance()->set($key, $value);
        }
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
