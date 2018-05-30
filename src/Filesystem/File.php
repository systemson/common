<?php

namespace Amber\Filesystem;

class File
{
    /**
     * @var string The name of the file.
     */
    public $name;

    /**
     * @var string The content of the file.
     */
    public $content;

    /**
     * @var int The timestamp of the last update of the file.
     */
    public $timestamp;

    /**
     * @var int The size of the file in bytes.
     */
    public $size;

    /**
     * Instantiate the file class.
     *
     * @param string $path The path to the file.
     *
     * @return void
     */
    public function __construct($path)
    {

        /** Replace the "." to "/" to get the path. */
        $path = str_replace('.', '/', $path);

        /* Checks if the file exists. */
        if (Filesystem::has($path.'.php')) {

            /* Set the name of the file. */
            $this->name = $path.'.php';

            /* Set the timestamp of the file. */
            $this->timestamp = Filesystem::getTimestamp($this->name);

            /*
             * Set the raw content of the file.
             * @todo Sanitize the content of the file(?).
             */
            $this->content = Filesystem::read($this->name);

            /* Set the size of the file. */
            $this->size = Filesystem::getSize($this->name);
        } else {
            /* @todo Throw error "File doesn't exist. */
        }
    }

    /**
     * Output the content of the file.
     *
     * @todo This method should return the safe content after sanitized.
     *
     * @return string The content of the file.
     */
    public function output()
    {
        return $this->content;
    }
}
