<?php

namespace Amber\Config;

interface ConfigAwareInterface
{
    public function setConfig(array $config);

    public function getConfig(string $key, $default = null);
}
