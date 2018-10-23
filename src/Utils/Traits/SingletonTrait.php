<?php

namespace Amber\Utils\Traits;

trait SingletonTrait
{
    /**
     * @var self The instance of the class.
     */
    private static $instance;

    /**
     * Returns the instance of the class.
     */
    public static function getInstance()
    {
        if (!self::$instance instanceof static) {
            self::$instance = new static();
        }

        return self::$instance;
    }
}
