<?php

namespace Tests;

use Amber\Utils\Implementations\AbstractNullObject;
use PHPUnit\Framework\TestCase;

class NullObjectTest extends TestCase
{
    public function testNullObject()
    {
        $null = $this->getMockForAbstractClass(AbstractNullObject::class);

        $this->assertNull($null->prop = null);
        $this->assertNull($null->prop);
        $this->assertNull($null());
        $this->assertTrue($null->isNull());
        $this->assertTrue($null->isEmpty());
        $this->assertEquals([], $null->toArray());
        $this->assertEquals('', (string) $null);
        $this->assertFalse(isset($null['key']));
        $this->assertFalse(isset($null->key));
        $null['key'] = 'value';
        $this->assertNull($null['key']);
        unset($null['key']);
        unset($null->key);
    }
}
