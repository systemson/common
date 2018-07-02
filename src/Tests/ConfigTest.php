<?php

namespace Amber\Tests;

use Amber\Config\ConfigAware;
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

        $config = $this->getMockForTrait(ConfigAware::class);

        $this->assertTrue($config->setConfig($variables));
        $this->assertEquals('value1', $config->getConfig('required1'));
    }
}
