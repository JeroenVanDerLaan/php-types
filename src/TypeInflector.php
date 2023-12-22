<?php

declare(strict_types=1);

namespace Jeroenvanderlaan\Types;

final class TypeInflector
{
    public static function typeof(mixed $value): Type
    {
        return match (true) {
            $value === null => Type::Null,
            is_bool($value) => Type::Bool,
            is_int($value) => Type::Int,
            is_float($value) => Type::Float,
            is_numeric($value) => Type::Number,
            is_string($value) => Type::String,
            is_scalar($value) => Type::Scalar,
            is_resource($value) => Type::Resource,
            is_callable($value) => Type::Callable,
            is_array($value) => self::getArrayType($value),
            is_iterable($value) => Type::Iterable,
            is_object($value) => Type::Object,
            default => Type::get(gettype($value)),
        };
    }

    public static function getArrayType(array $array): Type
    {
        $keys = self::getKeyTypes($array);
        if ($keys === [Type::Int]) {
            return Type::List;
        }
        if ($keys === [Type::String]) {
            return Type::Map;
        }
        return Type::Array;
    }

    /** @return non-empty-list<Type> */
    public static function getKeyTypes(iterable $array): array
    {
        $types = [];
        foreach ($array as $key => $value) {
            $type = self::typeof($key);
            $types[$type->value] = $type;
        }
        if (empty($types)) {
            return [Type::Int, Type::String];
        }
        return array_values($types);
    }

    /** @return non-empty-list<Type> */
    public static function getElementTypes(iterable $array): array
    {
        $types = [];
        foreach ($array as $value) {
            $type = self::typeof($value);
            $types[$type->value] = $type;
        }
        if (empty($types)) {
            return [Type::Mixed];
        }
        return array_values($types);
    }
}
