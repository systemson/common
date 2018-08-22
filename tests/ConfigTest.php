<?php

namespace Tests;

use Amber\Config\ConfigAwareClass;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function testTrueValidationsCache()
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

        $this->assertEquals('default', $config->getConfig('required1', 'default'));
    }
}
