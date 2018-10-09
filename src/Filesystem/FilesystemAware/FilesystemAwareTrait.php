<?php

namespace Amber\Filesystem\FilesystemAware;

use Amber\Filesystem\Filesystem;
use League\Flysystem\Filesystem as Flysystem;

trait FilesystemAwareTrait
{
    protected $filesystem;

    public function setFilesystem(Flysystem $filesystem): void
    {
        $this->filesystem = $filesystem;
    }

    public function getFilesystem(): Flysystem
    {
        /* Checks if the Filesystem is already instantiated. */
        if (!$this->filesystem instanceof Filesystem) {
            $this->filesystem = Filesystem::getInstance($this->getConfig('filesystem_path'));

            //$this->filesystem->setConfig($this->getFilesystemConfig());
        }

        return $this->filesystem;
    }

    /**
     * Gets the filesystem config vars
     *
     * @return array The filesystem config vars.
     */
    protected function getFilesystemConfig(): iterable
    {
        return $this->getConfig('filesystem') ?? [];
    }
}
