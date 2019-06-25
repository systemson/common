<?php

namespace Amber\Validator;

use Respect\Validation\Validator as v;
use Amber\Phraser\Phraser;

/**
 *
 */
class Validator
{
    public static function validate($argument, $validations)
    {
        if (is_string($validations)) {
            $validations = explode('|', $validations);
        }

        foreach ($validations as $validation) {
            $name = self::getRuleName($validation);

            $args = self::getRuleArgs($validation);

            $callback = call_user_func_array([new v(), $name], $args);

            if (!$callback->validate($argument)) {
                return self::doFalse();
            }
        }

        return self::doTrue();
    }

    public static function validateAll(array $pairs)
    {
        foreach ($pairs as $arg => $rule) {
            if (!self::validate($arg, $rule)) {
                return self::doFalse();
            }
        }

        return self::doTrue();
    }

    protected static function getRuleName($validation)
    {
        return (string) self::explodeNameArgs($validation)
            ->first()
            ->fromKebabCase()
            ->toCamelCase(true)
        ;
    }

    protected static function getRuleArgs($validation)
    {
         $exploded = self::explodeNameArgs($validation);

        if ($exploded->count() > 1) {
            return $exploded
                ->last()
                ->explode(',')
                ->toArray();
            ;
        }

        return [];
    }

    protected static function explodeNameArgs($validation)
    {
        return Phraser::explode($validation, ':');
    }

    protected static function doFalse()
    {
        return false;
    }

    protected static function doTrue()
    {
        return true;
    }
}
