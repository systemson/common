<?php

namespace Amber\Cache\Tests;

use Amber\Common\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    use Validator;

    public function testTrueValidationsCache()
    {
        $validator = $this->getMockForTrait(Validator::class);

        /* Test strings */
        $this->assertTrue($this->isString('string'));
        $this->assertTrue($this->isString(Validator::class));
        $this->assertTrue($this->isString("2"));

        /* Test number */
        $this->assertTrue($this->isNumeric(1));
        $this->assertTrue($this->isNumeric(1.1));
        $this->assertTrue($this->isNumeric("2.5"));

        /* Test iterable */
        $this->assertTrue($this->isIterable([]));
        $this->assertTrue($this->isIterable([1,2]));
        $this->assertTrue($this->isIterable($this->createMock(\IteratorAggregate::class)));

        /* Test callable */
        $this->assertTrue($this->isCallable(function () {}));
        $this->assertTrue($this->isCallable(function ($arg) {return $arg;}));
        $this->assertTrue($this->isCallable(TestCase::class));
        $this->assertTrue($this->isCallable('PHPUnit\Framework\TestCase'));
        $this->assertTrue($this->isCallable(TestCase::class, 'assertTrue'));
        $this->assertTrue($this->isCallable('PHPUnit\Framework\TestCase', 'assertTrue'));
        $this->assertTrue($this->isCallable($this, 'assertTrue'));

        /* Test types */
        $this->assertSame('string', $this->getType('string'));
        $this->assertSame('array', $this->getType([]));
        $this->assertSame('integer', $this->getType(1));
        $this->assertSame('double', $this->getType(1.1));
        $this->assertSame('double', $this->getType(7E-10));
        $this->assertSame('class', $this->getType(TestCase::class));

        /* Test same type */
        $this->assertTrue($this->sameType('first', 'second'));
        $this->assertTrue($this->sameType(2, 5));
        $this->assertTrue($this->sameType([], [1,2,3]));
        $this->assertTrue($this->sameType($this->createMock(\IteratorAggregate::class), new \stdClass()));
    }

    public function testStringException()
    {
         $this->expectException(\InvalidArgumentException::class);
         $this->isString(1);
    }

    public function testNumericException()
    {
         $this->expectException(\InvalidArgumentException::class);
         $this->isNumeric('one');
    }

    public function testIterableException()
    {
         $this->expectException(\InvalidArgumentException::class);
         $this->isIterable('[1, 2, 3]');
    }

    public function testCallableException()
    {
         $this->expectException(\InvalidArgumentException::class);
         $this->isCallable(UnkownClass::class);
    }
}
