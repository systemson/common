<?php

namespace Tests;

use Amber\Config\ConfigAwareClass;
use Amber\Config\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function testConfig()
    {
        $variables = [
            'required1' => 'value1',
            'required2' => 'value2',
            'optional1' => 'value3',
            'optional2' => 'value4',
            'optional3' => 'value5',
            'optional4' => 'value6',
        ];

        $config = $this->getMockForAbstractClass(ConfigAwareClass::class);

        /* Set the config vars */
        $this->assertTrue($config->setConfig($variables));

        /* Gets a config var previosly setted */
        $this->assertEquals('value1', $config->getConfig('required1'));

        /* Gets a config var from a class constant */
        $this->assertEquals('local', $config->getConfig('environment'));

        /* Empties the config */
        $config->clearConfig();

        /* Gets deault value */
        $this->assertEquals('default', $config->getConfig('required1', 'default'));

        /* Empties the config */
        $config->clearConfig();

        return $config;
    }

    /**
     * @depends testConfig
     */
    public function testMultidimensionalConfigs($config)
    {
        $variables = [
            'first' => [
                'second' => [
                    'third' => 'value',
                ],
            ],
        ];

        /* Set the config vars */
        $this->assertTrue($config->setConfig($variables));

        /* Gets a config var previosly setted */
        $this->assertTrue($config->hasConfig('first.second.third'));

        /* Gets a config var previosly setted */
        $this->assertEquals('value', $config->getConfig('first.second.third', 'default'));
    }
}
