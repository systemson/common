<?php

namespace Amber\Sketch\Engine;

/**
 * Handle directories in the file system.
 */
class Directory
{
    /**f
     * @var string The name of the directory.
     */
    public $name;

    /**
     * @var string The path to the directory.
     */
    public $path;

    /**
     * Instantiate the directory.
     *
     * @param string $name The name of the directory.
     * @param string $path The path to the directory.
     *
     * @return void
     */
    public function __construct($name, $path)
    {
        $this->name = $name;
        $this->path = $path;
    }

    /**
     * Checks if the directory exists.
     *
     * @return bool
     */
    public function exists()
    {
        return Filesystem::has($this->path);
    }

    /**
     * Create the directory.
     *
     * @return void
     */
    public function create()
    {
        if (!$this->exists()) {
            Filesystem::createDir($this->path);
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
            Filesystem::deleteDir($this->path);
        }
    }
}
