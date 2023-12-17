<?php

declare(strict_types=1);

namespace Jeroenvanderlaan\Types;

use Traversable;

final class Formatter
{
    public static function formatTypeOf(mixed $value): string
    {
        $type = Inflector::getTypeOf($value);
        if ($type->isEqualTo(Type::Object)) {
            return get_class($value);
        }
        if (is_iterable($value)) {
            return self::formatArrayType($value);
        }
        return $type->value;
    }

    public static function formatArrayType(iterable $array): string
    {
        $type = Inflector::getTypeOf($array)->value;
        $union = self::formatElementTypes($array);
        if ($array instanceof Traversable) {
            $type = get_class($array);
        }
        return "{$type}<{$union}>";
    }

    public static function formatKeyTypes(iterable $array): string
    {
        $names = [];
        foreach ($array as $key => $value) {
            $names[] = self::formatTypeOf($key);
        }
        if (empty($names)) {
            $names[] = Type::Int->value;
            $names[] = Type::String->value;
        }
        return implode('|', array_unique($names));
    }

    public static function formatElementTypes(iterable $array): string
    {
        $names = [];
        foreach ($array as $value) {
            $names[] = self::formatTypeOf($value);
        }
        $names[0] ??= Type::Mixed->value;
        return implode('|', array_unique($names));
    }

    public static function formatUnionTypes(Type ...$types): string
    {
        $names = [];
        foreach ($types as $type) {
            $names[] = $type->value;
        }
        $names[0] ??= Type::Mixed->value;
        return implode('|', array_unique($names));
    }
}
