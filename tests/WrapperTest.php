<?php

namespace Tests;

use Amber\Utils\Implementations\AbstractNullObject;
use Tests\Example\ConcreteWrapper;
use Tests\Example\ConcreteWrapperArgs;
use Tests\Example\Model;
use Tests\Example\View;
use PHPUnit\Framework\TestCase;

class WrapperTest extends TestCase
{
    public function testWrapper()
    {
        ConcreteWrapper::setAccessor(Model::class);

        $this->assertEquals(1, ConcreteWrapper::getId());
    }

    public function testWrapperArgs()
    {
        $this->assertInstanceOf(View::class, ConcreteWrapperArgs::getView());

        $this->assertInstanceOf(Model::class, ConcreteWrapperArgs::getModel());
    }
}
