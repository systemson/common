<?php

namespace Amber\Config;

use Amber\Collection\Collection;

trait CollectionAwareTrait
{
    /**
     * @var The instance of the Collection.
     */
    protected $config;

    /**
     * Gets the Collection instance.
     *
     * @param array $array An instance of the Collection instance.
     *
     * @return array The instance of the Collection.
     */
    public function getConfigContainer(array $array = []): Collection
    {
        /* Checks if the CacheInterface is already instantiated. */
        if (!$this->config instanceof Collection) {
            $this->config = new Collection($array);
        }

        return $this->config;
    }
}
