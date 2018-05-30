<?php

namespace Amber\Filesystem;

use Carbon\Carbon;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem as Flysystem;

/**
 * A static singleton like implementation of the League/Flysystem class.
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

            /** Local instance */
            $local = new Local($basepath ?? getcwd());

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
     * @returns bool
     */
    public static function has($path)
    {
        return self::getInstance()->has($path);
    }

    /**
     * Writes a file into the file system.
     *
     * @param $path The relative path to file.
     * @param $content The content of the file.
     *
     * @returns bool
     */
    public static function put($path, $content = null)
    {
        return self::getInstance()->put($path, $content);
    }

    /**
     * Reads the content of a file from the file system.
     *
     * @param $path The relative path to file.
     *
     * @returns bool
     */
    public static function read($path)
    {
        return self::getInstance()->read($path);
    }

    /**
     * Deletes a file from the file system.
     *
     * @param $path The relative path to file.
     *
     * @returns bool
     */
    public static function delete($path)
    {
        return self::getInstance()->delete($path);
    }

    /**
     * Renames a file from the file system.
     *
     * @param $path The relative path to file.
     *
     * @returns bool
     */
    public static function rename($path, $new_path)
    {
        return self::getInstance()->rename($path, $new_path);
    }

    /**
     * Gets the mime type of a file from the file system.
     *
     * @param $path The relative path to file.
     *
     * @returns mixed
     */
    public static function getMimetype($path)
    {
        return self::getInstance()->getMimetype($path);
    }

    /**
     * Gets the last edited timestamp of a file from the file system.
     *
     * @param $path The relative path to file.
     *
     * @returns integer
     */
    public static function getTimestamp($path)
    {
        return self::getInstance()->getTimestamp($path);
    }

    /**
     * Gets the last edited date of a file from the file system.
     *
     * @param $path The relative path to file.
     *
     * @returns object Carbon instance with the last edited date.
     */
    public static function getLastUpdate($path)
    {
        return Carbon::createFromTimestamp(
            self::getTimestamp($path)
        )->format('Y-m-d H:m:s');
    }

    /**
     * Gets the last size in bytes of a file from the file system.
     *
     * @param $path The relative path to file.
     *
     * @returns integer
     */
    public static function getSize($path)
    {
        return self::getInstance()->getSize($path);
    }

    /**
     * Creates a directory in the file system.
     *
     * @param $path The relative path to file.
     *
     * @returns bool
     */
    public static function createDir($path)
    {
        return self::getInstance()->createDir($path);
    }

    /**
     * Deletes a directory from the file system.
     *
     * @param $path The relative path to file.
     *
     * @returns bool
     */
    public static function deleteDir($path)
    {
        return self::getInstance()->deleteDir($path);
    }
}
