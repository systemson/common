<?php

namespace Amber\Cache\Tests;

use Amber\Common\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    public function testTrueValidationsCache()
    {
        $validator = $this->getMockForTrait(Validator::class);

        /* Test strings */
        $this->assertTrue($validator->isString('string'));
        $this->assertTrue($validator->isString(Validator::class));
        $this->assertTrue($validator->isString("2"));

        /* Test number */
        $this->assertTrue($validator->isNumeric(1));
        $this->assertTrue($validator->isNumeric(1.1));
        $this->assertTrue($validator->isNumeric("2.5"));

        /* Test iterable */
        $this->assertTrue($validator->isIterable([]));
        $this->assertTrue($validator->isIterable([1,2]));
        $this->assertTrue($validator->isIterable($this->createMock(\IteratorAggregate::class)));

        /* Test callable */
        $this->assertTrue($validator->isCallable(function () {}));
        $this->assertTrue($validator->isCallable(function ($validator) {}));
        $this->assertTrue($validator->isCallable(TestCase::class));
        $this->assertTrue($validator->isCallable('PHPUnit\Framework\TestCase'));
        $this->assertTrue($validator->isCallable(Validator::class, 'isCallable'));
        $this->assertTrue($validator->isCallable('Amber\Common\Validator', 'isCallable'));
        $this->assertTrue($validator->isCallable($validator, 'isCallable'));

        /* Test types */
        $this->assertSame('string', $validator->getType('string'));
        $this->assertSame('array', $validator->getType([]));
        $this->assertSame('integer', $validator->getType(1));
        $this->assertSame('double', $validator->getType(1.1));
        $this->assertSame('double', $validator->getType(7E-10));
        $this->assertSame('class', $validator->getType(TestCase::class));

        /* Test same type */
        $this->assertTrue($validator->sameType('first', 'second'));
        $this->assertTrue($validator->sameType(2, 5));
        $this->assertTrue($validator->sameType([], [1,2,3]));
        $this->assertTrue($validator->sameType($this->createMock(\IteratorAggregate::class), new \stdClass()));
    }

    public function testStringException()
    {
         $this->expectException(\InvalidArgumentException::class);
         $validator = $this->getMockForTrait(Validator::class);
         $validator->isString(1);
    }

    public function testNumericException()
    {
         $this->expectException(\InvalidArgumentException::class);
         $validator = $this->getMockForTrait(Validator::class);
         $validator->isNumeric('one');
    }

    public function testIterableException()
    {
         $this->expectException(\InvalidArgumentException::class);
         $validator = $this->getMockForTrait(Validator::class);
         $validator->isIterable('[1, 2, 3]');
    }

    public function testCallableException()
    {
         $this->expectException(\InvalidArgumentException::class);
         $validator = $this->getMockForTrait(Validator::class);
         $validator->isCallable(UnkownClass::class);
    }
}
