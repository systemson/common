<?php

namespace Amber\Validator;

use Respect\Validation\Validator as v;
use Amber\Phraser\Phraser;

/**
 *
 */
class Validator
{
    public static function validate($subject, $validations)
    {
        if (is_string($validations)) {
            $validations = explode('|', $validations);
        }

        foreach ($validations as $validation) {
            $name = self::getRuleName($validation);

            $args = self::getRuleArgs($validation);

            $callback = call_user_func_array([new v(), $name], $args);

            if (!$callback->validate($subject)) {
                return self::doFalse($subject, $validation);
            }
        }

        return self::doTrue($subject, $validation);
    }

    public static function validateAll(array $pairs)
    {
        foreach ($pairs as $subject => $validation) {
            if (!self::validate($subject, $validation)) {
                return self::doFalse($subject, $validation);
            }
        }

        return self::doTrue($subject, $validation);
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
            $args = $exploded
                ->last()
                ->explode(',')
                ->toArray();
            ;

            return array_map(function ($value) {
                if ($value == 'null') {
                    return null;
                }

                /*if ($value == 'true') {
                    return true;
                }

                if ($value == 'false') {
                    return false;
                }*/

                return $value;
            }, $args);
        }

        return [];
    }

    protected static function explodeNameArgs($validation)
    {
        return Phraser::explode($validation, ':');
    }

    protected static function doFalse($subject, string $validation)
    {
        return false;
    }

    protected static function doTrue($subject, string $validation)
    {
        return true;
    }
}
