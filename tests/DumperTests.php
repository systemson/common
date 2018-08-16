<?php

namespace Tests;

use Amber\Dumper\Dumper;
use PHPUnit\Framework\TestCase;

class DumperTest extends TestCase
{
    public function testDumper()
    {
        $dumper = new Dumper(
            new class {
                public $string = 'string';

                public $number = 1;

                public $array = [1,2,3];

                public $object;

                public function __construct()
                {
                    $this->object = new \stdClass();

                    $this->object->string = 'string';
                    $this->object->number = '1';
                    $this->object->array = [1,2,3];
                    $this->object->object = new \stdClass();
                }

                public function publicMethod()
                {
                    return;
                }

                private function privateMethod()
                {
                    return;
                }

                protected function protectedMethod()
                {
                    return;
                }
            }
        );

        //var_dump($dumper->methods);
    }
}
