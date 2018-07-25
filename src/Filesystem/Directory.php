<?php

namespace Amber\Sketch\Engine;

use League\Flysystem\Directory as base;

/**
 * Handle directories in the file system.
 */
class Directory extends base
{
    /**f
     * @var string The name of the directory.
     */
    public $name;

    /**
     * Checks if the directory exists.
     *
     * @return bool
     */
    public function exists()
    {
        return $this->filesystem->has($this->path);
    }

    /**
     * Create the directory.
     *
     * @return void
     */
    public function create()
    {
        if (!$this->exists()) {
            $this->filesystem->createDir($this->path);
        }
    }

    /**
     * Delete the directory.
     *
     * @return void
     */
    public function delete()
    {
        if ($this->exists()) {
            $this->filesystem->deleteDir($this->path);
        }
    }
}
