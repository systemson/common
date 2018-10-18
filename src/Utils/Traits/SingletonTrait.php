<?php

namespace Amber\Utils\Traits;

trait SingletonTrait
{
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
