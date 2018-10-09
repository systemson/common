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

    /*public $styles =
    [
        'string' => [
            'type_color' => 'green',
            'type_length' => strlen($data),
            'type_data' => '"' . htmlentities($data) . '"',
        ],
        'float' => [
            'type_color' => '#0099c5',
            'type_length' => strlen($data),
            'type_data' => htmlentities($data),
        ],
        'integer' => [
            'type_color' => 'red',
            'type_length' => strlen($data),
            'type_data' => htmlentities($data),
        ],
        'boolean' =>[
            'type_color' => '#92008d',
            'type_length' => strlen($data),
            'type_data' => $data ? 'true' : 'false',
        ],
        'null' => [
            'type_length' => 0,
        ],
        'array' => [
            'type_length' => count($data),
        ],
    ];*/

    public function __construct($data)
    {
        $reflection = new Reflector($data);

        $this->properties = $reflection->getProperties();
        $this->methods = $reflection->getMethods();
    }
}
