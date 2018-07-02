<?php

namespace Amber\Config;

trait ConfigAware
{
    /**
     * @var array The config container.
     */
    protected $config = [];

    /**
     * Sets the config enviroment variables.
     *
     * @param array $config A asociative array containing the config variables.
     *
     * @return void
     */
    public function setConfig(array $config)
    {
        foreach ($config as $key => $value) {
            $this->config[$key] = $value;
        }

        return true;
    }

    /**
     * gets a config enviroment variables by it's key.
     *
     * @param string $key The key to search for.
     * @param mixed  $default The defualt value to return if the key is not found.
     *
     * @return mixed The config value.
     */
    public function getConfig(string $key, $default = null)
    {
        $config = $this->config;

        foreach (explode('.', $key) as $search) {
            if (isset($config[$search])) {
                $config = $config[$search];
            } else {
                return $default;
            }
        }

        return $config;
    }

    /**
     * Cleares the config enviroment variables.
     *
     * @return void
     */
    public function clearConfig(string $key, $default = null)
    {
        $this->config = [];
    }

    /**
     * Checks that the .
     *
     * @return void
     */
    public function validateConfig()
    {
        if (REQUIRED_CONFIG) {
            foreach (REQUIRED_CONFIG as $required) {
                if (!$this->get($required)) {
                    throw new \Exception('The config is not ready. Missing {$required}.');
                }
            }
        }

        return true;
    }
}
