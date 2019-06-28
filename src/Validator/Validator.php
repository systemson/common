<?php

namespace Amber\Validator;

use Respect\Validation\Validator as v;
use Amber\Phraser\Phraser;
use Respect\Validation\Exceptions\NestedValidationException;

/**
 *
 */
class Validator
{
    protected static $messages = [];

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

    public static function setMessages(array $messages = [])
    {
        self::$messages = $messages;
    }

    public static function getMessages()
    {
        return self::$messages;
    }

    public static function assert(array $ruleSet, $object) 
    {
        $validator = new v();

        foreach ($ruleSet as $attr => $validations) {
            $rules = new v();

            foreach (explode('|', $validations) as $validation) {
                $name = self::getRuleName($validation);

                $args = self::getRuleArgs($validation);

                $rules = call_user_func_array([$rules, $name], $args);
            }

            $validator = call_user_func_array([$validator, 'attribute'], [$attr, $rules]);
        }

        try {
            $validator->assert($object);
        } catch (NestedValidationException $e) {
            $errors = $e->findMessages(self::getMessages());

            return $e->getMessages();
        }

        return true;
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
