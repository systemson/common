<?php

namespace Amber\Filesystem;

use Amber\Utils\Implementations\BaseFactory;
use Amber\Filesystem\File;

class FileFactory extends BaseFactory
{
    public static function createFile($path, $content)
    {
        return self::make(File::class, [$path, $content]);
    }
}
