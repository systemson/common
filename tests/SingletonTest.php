<?php

namespace Tests;

use Amber\Utils\Implementations\AbstractSingleton;
use Tests\Example\ConcreteSingleton;
use PHPUnit\Framework\TestCase;
use Exception;
use Error;

class SingletonTest extends TestCase
{
    public function testSingleton()
    {
        $this->assertNull(ConcreteSingleton::testMethod());
    }

    public function testNoneExistingMethod()
    {
        $this->expectException(Error::class);

        ConcreteSingleton::unkownMethod();
    }

    public function testNonePublicMethod()
    {
        $this->expectException(Exception::class);

        ConcreteSingleton::privateMethod();
    }

    public function testCloning()
    {
        $this->expectException(Exception::class);

        $singleton = ConcreteSingleton::getInstance();

        $clone = clone $singleton;
    }

    public function testUnserialize()
    {
        $this->expectException(Exception::class);

        $singleton = ConcreteSingleton::getInstance();

        $serialized = serialize($singleton);
        $unserialized = unserialize($serialized);
    }
}
