<?php

namespace Amber\Filesystem\FilesystemAware;

use League\Flysystem\Filesystem;

interface FileSystemAwareInterface
{
    public function setFilesystem(Filesystem $filesystem): void;

    public function getFilesystem(): Filesystem;
}
