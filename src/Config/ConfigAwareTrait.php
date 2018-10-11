<?php

namespace Amber\Config;

use Amber\Collection\Collection;

trait ConfigAwareTrait
{
    /**
     * @var Amber\Collection\Collection.
     */
    protected $config;

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
        Config::set($config);

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
        if (Config::has($key)) {
            return Config::get($key);
        }

        if (defined('static::' . strtoupper($key))) {
            return constant('static::' . strtoupper($key));
        }

        return $default;
    }

    /**
     * Gets and array with all the config vars.
     *
     * @return array The config vars
     */
    public function getConfigs(array $array = [])
    {
        return Config::all();
    }

    /**
     * Whether a config enviroment variable is present in the container.
     *
     * @return bool
     */
    public function hasConfig($key)
    {
        return Config::has($key);
    }

    /**
     * Cleares the config enviroment variables.
     *
     * @return void
     */
    public function clearConfig()
    {
        Config::clear();
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
