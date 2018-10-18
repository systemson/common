<?php

namespace Amber\Utils\Implementations;


use Amber\Utils\Traits\BaseFactoryTrait;
use Amber\Utils\Traits\SingletonTrait;

/**
 * Implementation of a singleton factory class.
 */
abstract class SingletonFactory extends AbstractSingleton
{
    use BaseFactoryTrait, SingletonTrait;
}
