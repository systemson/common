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
        foreach ($config as $key => $value) {
            $this->getConfigContainer()->put($key, $value);
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
        $config = $this->getConfigContainer()->all();

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
     * Gets and array with all the config vars.
     *
     * @return array The config vars
     */
    public function getConfigs()
    {
        return $this->getConfigContainer()->all();
    }

    /**
     * Cleares the config enviroment variables.
     *
     * @return void
     */
    public function clearConfig()
    {
        $this->getConfigContainer()->clear();
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

    /**
     * Gets the Config's Collection.
     *
     * @param array $array An instance of the Collection instance.
     *
     * @return array The instance of the Collection.
     */
    protected function getConfigContainer(): Collection
    {
        /* Checks if the CacheInterface is already instantiated. */
        if (!$this->config instanceof Collection) {
            $this->config = new Collection();
        }

        return $this->config;
    }
}
