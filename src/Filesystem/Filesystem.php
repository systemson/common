<?php

namespace Amber\Filesystem;

use Carbon\Carbon;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem as Flysystem;
use Amber\Utils\Implementations\AbstractWrapper;
use Amber\Utils\Contracts\ArgumentAwareInterface;
use Amber\Utils\Traits\ArgumentAwareTrait;


/**
 * A static singleton like implementation of the League/Flysystem class.
 *
 * @todo Must implement Amber\Config\ConfigAwareInterface
 * @todo Must extend    Amber\Utils\Abstracts\AbstractSingleton
 */
class Filesystem extends AbstractWrapper implements ArgumentAwareInterface
{
    use ArgumentAwareTrait;

    /**
     * @var The class accessor.
     */
    protected static $accessor = Flysystem::class;

    /**
     * Runs before the class constructor.
     *
     * @return void
     */
    public static function beforeConstruct(): void
    {
        $local = new Local(getcwd());
        static::setArguments($local);
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
        if (static::getInstance()->has($path)) {
            $old_content = static::getInstance()->read($path);

            $content = $old_content . PHP_EOL . $content;
        }

        return static::getInstance()->put($path, $content);
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
            static::getTimestamp($path)
        )->format('Y-m-d H:m:s');
    }

    /**
     *
     */
    public static function fixPath($path)
    {
        return str_replace(['/', '//', '\\', '\\\\'], DIRECTORY_SEPARATOR, $path);
    }
}
