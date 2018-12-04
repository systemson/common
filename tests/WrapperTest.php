<?php

namespace Tests;

use Amber\Utils\Implementations\AbstractNullObject;
use Tests\Example\ConcreteWrapper;
use Tests\Example\Model;
use PHPUnit\Framework\TestCase;

class WrapperTest extends TestCase
{
    public function testWrapper()
    {
        ConcreteWrapper::setAccessor(Model::class);

        $this->assertEquals(1, ConcreteWrapper::getId());
    }
}
