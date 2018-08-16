<?php

namespace Amber\Dumper;

use Amber\Validator\Validator;
use Amber\Reflector\Reflector;

/**
 *
 */
class Dumper
{
    use Validator;

    public $dump;
    public $properties;
    public $methods;

    public function __construct($data)
    {
        $reflection = new Reflector($data);

        $this->properties = $reflection->getProperties();
        $this->methods = $reflection->getMethods();
    }
}
