<?php

namespace Amber\Config;

interface ConfigAwareInterface
{
    const ENVIRONMENT = 'local';

    public function setConfig(array $config);

    public function getConfig(string $key, $default = null);
}
