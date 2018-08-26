<?php

namespace Amber\Filesystem\FilesystemAware;

use League\Flysystem\Filesystem;

interface FileSystemAwareInterface
{
    public function setFilesystem(Filesystem $filesystem);

    public function getFilesystem(): Filesystem;
}
