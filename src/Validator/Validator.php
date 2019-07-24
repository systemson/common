<?php

namespace Amber\Validator;

use Respect\Validation\Validator as v;
use Amber\Phraser\Phraser;
use Respect\Validation\Exceptions\NestedValidationException;
use Amber\Collection\Collection;

/**
 *
 */
class Validator
{
    protected static $messages = [];

    protected static $attributes = [];

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

    public static function getMessages(): array
    {
        return self::$messages;
    }

    public static function setMessage(string $name, string $value): self
    {
        self::$messages[$name] = $value;

        return $this;
    }

    public static function hasMessage(string $name): bool
    {
        return isset(self::$messages[$name]);
    }

    public static function getMessage(string $name): string
    {
        return self::$messages[$name] ?? '';
    }

    public static function setAttributes(array $attributes = [])
    {
        self::$attributes = $attributes;
    }

    public static function getAttributes(): array
    {
        return self::$attributes;
    }

    public static function setAttribute(string $name, string $value): self
    {
        self::$attributes[$name] = $value;

        return $this;
    }

    public static function hasAttribute(string $name): bool
    {
        return isset(self::$attributes[$name]);
    }

    public static function getAttribute(string $name): string
    {
        return self::$attributes[$name] ?? '';
    }

    public static function assert(array $ruleSet, $values)
    {
        $validator = new v();

        foreach ($ruleSet as $attr => $validations) {

            if (!isset($values[$attr]) && static::isOptional($validations)) {
                continue;
            }

            $rules = new v();

            foreach (explode('|', $validations) as $validation) {
                if ($validation == 'optional') {
                    continue;
                }

                $name = self::getRuleName($validation);

                $args = self::getRuleArgs($validation);

                $rules = call_user_func_array([$rules, $name], $args);
            }


            $validator = call_user_func_array([$validator, 'key'], [$attr, $rules]);
        }

        try {
            $validator->assert($values);
        } catch (NestedValidationException $e) {
            return new Collection($e->getMessages());
        }

        return true;
    }

    protected static function isOptional(string $validations = ''): bool
    {
        if (strpos($validations, 'optional') !== false) {
            return true;
        }

        return false;
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

                switch ($value) {
                    case 'null':
                        return null;
                        break;

                    case 'true':
                        return true;
                        break;

                    case 'false':
                        return false;
                        break;
                    
                    default:
                        return $value;
                        break;
                }
            }, $args);
        }

        return [];
    }

    protected static function getErrors(NestedValidationException $e): iterable
    {
        $errors = new Collection();

        foreach ($e as $exception) {
            $name = $exception->getMessage();
            $id = $exception->getId();

            /*if (self::hasMessage($id)) {
                $messages = $e->findMessages([
                    $id => self::getMessage($id)
                ]);*/
            //} else {
                $messages[$id] = $exception->findMessages();
            //}

            //list($name, $messages) = self::translateAttributeName($name, $messages);

            $errors->set($name, $messages);
        }

        return $errors;
    }

    protected static function translateAttributeName(string $name, array $messages = []): array
    {
        if (self::hasAttribute($name)) {
            $locale = self::getAttribute($name);

            $messages = str_replace($name, $locale, $messages);

            return [$locale, $messages];
        }

        return [$name, $messages];

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
