<?php

namespace Amber\Filesystem;

/**
 * Directory list container.
 */
class Directories
{
    /**
     * @var array The v names and their paths.
     */
    public static $directories = [
        'views'    => '/app/views/',
        'layouts'  => '/app/views/layouts/',
        'includes' => '/app/views/includes/',
        'cache'    => '/tmp/views/',
    ];

    /**
     * Get or set the directory.
     *
     * @param string $name The name of the directory.
     * @param string $path The path of the directory.
     *
     * @return mixed
     */
    public static function directories($name, $path = null)
    {
        if ($path != null) {

            /* If the path is passed create a new Directory instance */
            return self::$directories[$name] = new Directory($name, $path);
        } else {

            /* If no path is passed return the directory object */
            return self::$directories[$name] ?? null;
        }
    }
}
