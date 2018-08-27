<?php

namespace Amber\Config;

trait ConfigAwareTrait
{
    /**
     * @var array The config container.
     */
    protected $config = [];

    /**
     * Sets the config enviroment variables.
     *
     * @todo Should return void.
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
     * Gets a config enviroment variable by it's unique key.
     *
     * @param string $key     The key to search for.
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
            } elseif (defined('static::' . strtoupper($search))) {
                return constant('static::' . strtoupper($search));
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
    public function clearConfig()
    {
        $this->config = [];
    }

    /**
     * Checks that the required config enviroment variables are being set.
     *
     * @return void
     */
    public function validateConfig()
    {
        if (static::REQUIRED_CONFIG) {
            foreach (static::REQUIRED_CONFIG as $required) {
                if (!$this->getConfig($required)) {
                    return false;
                }
            }
        }

        return true;
    }
}
