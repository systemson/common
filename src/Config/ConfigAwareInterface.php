<?php

namespace Amber\Config;

interface ConfigAwareInterface
{
    const ENVIRONMENT = 'local';

    /**
     * Sets the config enviroment variables.
     *
     * @todo Should return void.
     *
     * @param array $config A asociative array containing the config variables.
     *
     * @return void
     */
    public function setConfig(array $config);

    /**
     * Gets a config enviroment variable by it's unique key.
     *
     * @param string $key     The key to search for.
     * @param mixed  $default The defualt value to return if the key is not found.
     *
     * @return mixed The config value.
     */
    public function getConfig(string $key, $default = null);
}
