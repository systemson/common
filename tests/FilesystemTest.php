<?php

namespace Tests;

use Amber\Filesystem\Filesystem;
use PHPUnit\Framework\TestCase;

class FilesystemTest extends TestCase
{
    public function testFilesystem()
    {
        $filesystem = Filesystem::getInstance(getcwd());

        $folder = 'tmp/filesystem/';
        $name = 'test.txt/';
        $fullname = $folder . $name;
        $content = 'This is a test content';

        $this->assertTrue(Filesystem::createDir($folder));

        $this->assertFalse(Filesystem::has($fullname));

        $this->assertTrue(Filesystem::put($fullname, $content));

        $this->assertTrue(Filesystem::has($fullname));

        $this->assertEquals($content, Filesystem::read($fullname));

        $this->assertTrue(Filesystem::push($fullname, $content));

        $this->assertTrue(Filesystem::delete($fullname));

        $this->assertTrue(Filesystem::deleteDir($folder));
    }
}
