<?php

namespace Amber\Filesystem;

use Carbon\Carbon;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem as Flysystem;

/**
 * A static singleton like implementation of the League/Flysystem class.
 *
 * @todo Must implement Amber\Config\ConfigAwareInterface
 */
class Filesystem
{
    /**
     * @var object The instance of League\Flysysten.
     */
    protected static $instance;

    /**
     * Set private to prevent instantiation.
     */
    private function __construct()
    {
    }

    /**
     * Singleton implementation.
     */
    public static function getInstance($basepath = null)
    {
        /* Checks if the League/Flysystem is already instantiated. */
        if (!self::$instance instanceof Flysystem) {

            $basepath = $basepath != null ? self::fixPath($basepath) : getcwd();
            /** Local instance */
            $local = new Local($basepath);

            /* Instantiate the League/Flysystem class */
            self::$instance = new Flysystem($local);
        }

        /* Return the instance of League/Flysystem */
        return self::$instance;
    }

    /**
     * Checks if a file exists.
     *
     * @param $path The relative path to file.
     *
     * @return bool
     */
    public static function has($path)
    {
        return self::getInstance()->has(self::fixPath($path));
    }

    /**
     * Writes a file into the file system.
     *
     * @param $path The relative path to file.
     * @param $content The content of the file.
     *
     * @return bool
     */
    public static function put($path, $content = null)
    {
        return self::getInstance()->put(self::fixPath($path), $content);
    }

    /**
     * Reads the content of a file from the file system.
     *
     * @param $path The relative path to file.
     *
     * @return bool
     */
    public static function read($path)
    {
        return self::getInstance()->read(self::fixPath($path));
    }

    /**
     * Adds content at the end a file from the file system.
     *
     * @param $path    The relative path to file.
     * @param $content The new content to push in the file.
     *
     * @return bool
     */
    public static function push($path, $content)
    {
        $path = self::fixPath($path);

        if (self::getInstance()->has($path)) {
            $old_content = self::getInstance()->read($path);

            $content = $old_content . "\r\n" . $content;
        }

        return self::getInstance()->put($path, $content);
    }

    /**
     * Deletes a file from the file system.
     *
     * @param $path The relative path to file.
     *
     * @return bool
     */
    public static function delete($path)
    {
        return self::getInstance()->delete(self::fixPath($path));
    }

    /**
     * Renames a file from the file system.
     *
     * @param $path The relative path to file.
     *
     * @return bool
     */
    public static function rename($path, $new_path)
    {
        return self::getInstance()->rename(self::fixPath($path), self::fixPath($new_path));
    }

    /**
     * Gets the mime type of a file from the file system.
     *
     * @param $path The relative path to file.
     *
     * @return mixed
     */
    public static function getMimetype($path)
    {
        return self::getInstance()->getMimetype(self::fixPath($path));
    }

    /**
     * Gets the last edited timestamp of a file from the file system.
     *
     * @param $path The relative path to file.
     *
     * @return integer
     */
    public static function getTimestamp($path)
    {
        return self::getInstance()->getTimestamp(self::fixPath($path));
    }

    /**
     * Gets the last edited date of a file from the file system.
     *
     * @param $path The relative path to file.
     *
     * @return object Carbon instance with the last edited date.
     */
    public static function getLastUpdate($path)
    {
        return Carbon::createFromTimestamp(
            self::getTimestamp(self::fixPath($path))
        )->format('Y-m-d H:m:s');
    }

    /**
     * Gets the last size in bytes of a file from the file system.
     *
     * @param $path The relative path to file.
     *
     * @return integer
     */
    public static function getSize($path)
    {
        return self::getInstance()->getSize(self::fixPath($path));
    }

    /**
     * Creates a directory in the file system.
     *
     * @param $path The relative path to file.
     *
     * @return bool
     */
    public static function createDir($path)
    {
        return self::getInstance()->createDir(self::fixPath($path));
    }

    /**
     * Deletes a directory from the file system.
     *
     * @param $path The relative path to file.
     *
     * @return bool
     */
    public static function deleteDir($path)
    {
        return self::getInstance()->deleteDir(self::fixPath($path));
    }

    /**
     * Scans a directory.
     *
     * @param $path The relative path to file.
     *
     * @return bool
     */
    public static function listContents($path, $recursive = false)
    {
        return self::getInstance()->listContents(self::fixPath($path, $recursive));
    }

    /**
     *
     */
    protected static function fixPath($path)
    {
        return str_replace(['/', '//', '\\', '\\\\'], DIRECTORY_SEPARATOR, $path);
    }
}
