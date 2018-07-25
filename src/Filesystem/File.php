<?php

namespace Amber\Filesystem;

use League\Flysystem\File as base;

class File extends Base
{
    /**
     * @var string The name of the file.
     */
    public $name;

    /**
     * @var string The current content of the file.
     */
    public $content;

    /**
     * @var string The original content of the file.
     */
    protected $original;

    /**
     * Class constructor.
     *
     * @param string $path    The relative path to the file.
     * @param string $content Optional. The content of the file.
     */
    public function __construct($path, $content = null)
    {
        parent::__construct(Filesystem::getInstance(), $path);

        if ($this->exists()) {
            $this->content = $this->getContent();
        }
    }

    /**
     * Gets the absolute path of the file.
     *
     * @return string The absolute path of the file.
     */
    public function getFullPath()
    {
        return $this->getFilesystem()->getAdapter()->getPathPrefix() . $this->path;
    }

    /**
     * Gets the content of the file.
     *
     * @return string The content of the file.
     */
    public function getContent()
    {
        if ($this->exists()) {
            return $this->filesystem->read($this->path);
        }

        return $this->content;
    }

    /**
     * Sets the content of the file.
     *
     * @todo This method should return the safe content after sanitized.
     *
     * @return string The content of the file.
     */
    public function setContent($content)
    {
        $this->content = $content;

        return true;
    }

    /**
     * Stores the content in the file if it has change.
     *
     * @todo This method should return the safe content after sanitized.
     *
     * @return bool True on success.
     */
    public function save()
    {
        if ($this->original != $this->content) {
            $this->filesystem->put($this->path, $this->getContent());
            $this->original = $this->content;

            return true;
        }

        return false;
    }

    public function __toArray()
    {
        return [
            'name'     => $this->name,
            'path'     => $this->path,
            'content'  => $this->getContent(),
            'original' => $this->original,
        ];
    }
}
