<?php

namespace Amber\Filesystem\FilesystemAware;

use League\Flysystem\Filesystem;

trait FilesystemAwareTrait
{
    protected $filesystem;

    public function setFilesystem(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function getFilesystem(): Filesystem
    {
        /* Checks if the Filesystem is already instantiated. */
        if (!$this->filesystem instanceof Filesystem) {
            $this->filesystem = Filesystem::getInstance($this->getConfig('filesystem_path'));
        }

        return $this->filesystem;
    }
}
