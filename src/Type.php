<?php

declare(strict_types=1);

namespace Jeroenvanderlaan\Types;

use InvalidArgumentException;

enum Type: string
{
    case Mixed = 'mixed';
    case Null = 'null';
    case Bool = 'bool';
    case Int = 'int';
    case Float = 'float';
    case Number = 'number';
    case String = 'string';
    case Scalar = 'scalar';
    case Resource = 'resource';
    case Callable = 'callable';
    case Object = 'object';
    case List = 'list';
    case Map = 'map';
    case Array = 'array';
    case Iterable = 'iterable';

    public static function resolve(string $type): self
    {
        $type = strtolower($type);
        return match ($type) {
            'nil',
            'null' => self::Null,
            'true',
            'false',
            'boolean',
            'bool' => self::Bool,
            'long',
            'integer',
            'uint',
            'int' => self::Int,
            'inf',
            'infinity',
            'nan',
            'decimal',
            'real',
            'double',
            'float' => self::Float,
            'digit',
            'numeric',
            'number' => self::Number,
            'text',
            'char',
            'alpha',
            'alnum',
            'str',
            'string' => self::String,
            'primitive',
            'simple',
            'atom',
            'atomic',
            'scalar' => self::Scalar,
            'resource (closed)',
            'resource' => self::Resource,
            'func',
            'function',
            'closure',
            'callable' => self::Callable,
            'sequence',
            'list' => self::List,
            'assoc',
            'record',
            'dictionary',
            'map' => self::Map,
            'countable',
            'collection',
            'array' => self::Array,
            'iterator',
            'iterable' => self::Iterable,
            'instance',
            'object' => self::Object,
            'unknown type',
            'unknown',
            'any',
            'mixed' => self::Mixed,
            default => throw new InvalidArgumentException(
                "Unknown type '{$type}'"
            ),
        };
    }

    public function isEqualTo(self $type): bool
    {
        return $this->value === $type->value;
    }

    public function isOneOf(self ...$types): bool
    {
        foreach ($types as $type) {
            if ($this->isEqualTo($type)) {
                return true;
            }
        }
        return false;
    }

    public function isCoercedTo(self $type): bool
    {
        if ($type->isScalar() && $this->isScalar()) {
            return true;
        }
        if ($type->isArrayLike() && $this->isObjectLike()) {
            return true;
        }
        return false;
    }

    public function isMixed(): bool
    {
        return $this->isEqualTo(self::Mixed);
    }

    public function isNumeric(): bool
    {
        return $this->isOneOf(
            self::Int,
            self::Float,
            self::Number,
        );
    }

    public function isScalar(): bool
    {
        return $this->isOneOf(
            self::Null,
            self::Bool,
            self::Int,
            self::Float,
            self::Number,
            self::String,
            self::Scalar
        );
    }

    public function isComplex(): bool
    {
        return $this->isOneOf(
            self::Resource,
            self::Callable,
            self::Object,
            self::List,
            self::Map,
            self::Array,
            self::Iterable,
        );
    }

    public function isArrayLike(): bool
    {
        return $this->isOneOf(
            self::List,
            self::Map,
            self::Array,
            self::Iterable,
        );
    }

    public function isObjectLike(): bool
    {
        return $this->isOneOf(
            self::List,
            self::Map,
            self::Array,
            self::Iterable,
            self::Object,
        );
    }
}
