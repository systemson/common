<?php

namespace Tests;

use Amber\Validator\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    use Validator;

    public function testValidations()
    {
        $string = 'string';
        $class = TestCase::class;
        $array = [];
        $function = function () {
        };
        $validator = $this->getMockForTrait(Validator::class);

        /* Test strings */
        $this->assertTrue($this->isString($string, $class, '2'));

        $this->assertFalse($this->isString($string, $class, '2', 1));
        $this->assertFalse($this->isString(1));
        $this->assertFalse($this->isString($array));
        $this->assertFalse($this->isString($function));
        $this->assertFalse($this->isString($validator));

        /* Test number */
        $this->assertTrue($this->isNumeric(1, 1.1, '2.5'));

        $this->assertFalse($this->isNumeric(1, 1.1, '2.5', $string));
        $this->assertFalse($this->isNumeric($string));
        $this->assertFalse($this->isNumeric($array));
        $this->assertFalse($this->isNumeric($function));
        $this->assertFalse($this->isNumeric($validator));

        /* Test iterable */
        $this->assertTrue($this->isIterable([], [1, 2], $this->createMock(\IteratorAggregate::class)));

        $this->assertFalse($this->isIterable([], [1, 2], $this->createMock(\IteratorAggregate::class), 1));
        $this->assertFalse($this->isIterable(1));
        $this->assertFalse($this->isIterable($string));
        $this->assertFalse($this->isIterable($function));
        $this->assertFalse($this->isIterable($validator));

        /* Test callable */
        $this->assertTrue($this->isCallable(function () {
        }));
        $this->assertTrue($this->isCallable(function ($arg) {
            return $arg;
        }));
        $this->assertTrue($this->isCallable($class));
        $this->assertTrue($this->isCallable('PHPUnit\Framework\TestCase'));
        $this->assertTrue($this->isCallable($class, 'assertTrue'));
        $this->assertTrue($this->isCallable('PHPUnit\Framework\TestCase', 'assertTrue'));
        $this->assertTrue($this->isCallable($this, 'assertTrue'));

        $this->assertFalse($this->isCallable(1));
        $this->assertFalse($this->isCallable($string));
        $this->assertFalse($this->isCallable($array));
        $this->assertFalse($this->isCallable($validator));

        /* Test Class */
        $this->assertTrue($this->isClass($class, TestCase::class));

        $this->assertFalse($this->isClass(UnkownClass::class));
        $this->assertFalse($this->isClass('UnkownClass'));
        $this->assertFalse($this->isClass(1));
        $this->assertFalse($this->isClass($string));
        $this->assertFalse($this->isClass($array));
        $this->assertFalse($this->isClass($validator));
        $this->assertFalse($this->isClass(''));

        /* Test types */
        $this->assertSame('string', $this->getType('string'));
        $this->assertSame('array', $this->getType([]));
        $this->assertSame('integer', $this->getType(1));
        $this->assertSame('double', $this->getType(1.1));
        $this->assertSame('double', $this->getType(7E-10));
        $this->assertSame('class', $this->getType($class));

        /* Test same type */
        $this->assertTrue($this->sameType('first', 'second'));
        $this->assertTrue($this->sameType(2, 5));
        $this->assertTrue($this->sameType([], [1, 2, 3]));
        $this->assertTrue($this->sameType($this->createMock(\IteratorAggregate::class), new \stdClass()));
    }
}
