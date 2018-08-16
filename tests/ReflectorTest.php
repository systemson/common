<?php

namespace Tests;

use Amber\Reflector\Reflector;
use Tests\Example\Controller;
use Tests\Example\Model;
use PHPUnit\Framework\TestCase;

class ReflectorTest extends TestCase
{
    public function testReflector()
    {
        $controller_reflection = new Reflector(Controller::class);
        $model_reflection = new Reflector(Model::class);

        /* Test reflection instance. */
        $this->assertInstanceOf(
            \ReflectionClass::class,
            $controller_reflection->reflection
        );

        /* Test if the instance returned by inflector is an instance of ReflectorClass. */
        $this->assertInstanceOf(
            Controller::class,
            $controller_reflection->newInstance([1, new Model()])
        );
        $this->assertInstanceOf(
            Model::class,
            $model_reflection->newInstance()
        );

        /* Test if the Reflector class reads the injectable properties */
        $this->assertSame(
            'view',
            $controller_reflection->getInjectables()[0]->name
        );

        /* Test that the injectable property prevents from being readed twice. */
        $this->assertSame(
            $controller_reflection->getInjectables(),
            $controller_reflection->getInjectables()
        );
    }
}
