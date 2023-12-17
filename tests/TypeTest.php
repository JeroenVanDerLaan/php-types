<?php

declare(strict_types=1);

namespace Jeroenvanderlaan\Types\Tests;

use Jeroenvanderlaan\Types\Type;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Type::class)]
class TypeTest extends TestCase
{
    public function testResolveToNull(): void
    {
        $type = Type::resolve('null');
        $this->assertEquals(Type::Null, $type);
    }

    public function testResolveToBool(): void
    {
        $type = Type::resolve('bool');
        $this->assertEquals(Type::Bool, $type);
    }

    public function testResolveToInt(): void
    {
        $type = Type::resolve('int');
        $this->assertEquals(Type::Int, $type);
    }

    public function testResolveToFloat(): void
    {
        $type = Type::resolve('float');
        $this->assertEquals(Type::Float, $type);
    }

    public function testResolveToNumber(): void
    {
        $type = Type::resolve('number');
        $this->assertEquals(Type::Number, $type);
    }

    public function testResolveToString(): void
    {
        $type = Type::resolve('string');
        $this->assertEquals(Type::String, $type);
    }

    public function testResolveToScalar(): void
    {
        $type = Type::resolve('scalar');
        $this->assertEquals(Type::Scalar, $type);
    }

    public function testResolveToResource(): void
    {
        $type = Type::resolve('resource');
        $this->assertEquals(Type::Resource, $type);
    }

    public function testResolveToCallable(): void
    {
        $type = Type::resolve('callable');
        $this->assertEquals(Type::Callable, $type);
    }

    public function testResolveToList(): void
    {
        $type = Type::resolve('list');
        $this->assertEquals(Type::List, $type);
    }

    public function testResolveToMap(): void
    {
        $type = Type::resolve('map');
        $this->assertEquals(Type::Map, $type);
    }

    public function testResolveToArray(): void
    {
        $type = Type::resolve('array');
        $this->assertEquals(Type::Array, $type);
    }

    public function testResolveToIterable(): void
    {
        $type = Type::resolve('iterable');
        $this->assertEquals(Type::Iterable, $type);
    }

    public function testResolveToObject(): void
    {
        $type = Type::resolve('object');
        $this->assertEquals(Type::Object, $type);
    }

    public function testResolveToMixed(): void
    {
        $type = Type::resolve('mixed');
        $this->assertEquals(Type::Mixed, $type);
    }

    public function testResolveToInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        Type::resolve('invalid');
    }

    public function testIsEqualTo(): void
    {
        $type = Type::Null;
        $this->assertTrue($type->isEqualTo(Type::Null));
    }

    public function testIsOneOf(): void
    {
        $type = Type::Null;
        $this->assertTrue($type->isOneOf(Type::Null, Type::Bool));
    }

    public function testIsNotOneOf(): void
    {
        $type = Type::Null;
        $this->assertFalse($type->isOneOf(Type::Bool, Type::Int));
    }

    public function testIsCoercedToScalar(): void
    {
        $type = Type::Int;
        $this->assertTrue($type->isCoercedTo(Type::Number));
    }

    public function testIsCoercedToArray(): void
    {
        $type = Type::Iterable;
        $this->assertTrue($type->isCoercedTo(Type::Array));
    }

    public function testIsNotCoercedTo(): void
    {
        $type = Type::Iterable;
        $this->assertFalse($type->isCoercedTo(Type::Bool));
    }

    public function testIsMixed(): void
    {
        $type = Type::Mixed;
        $this->assertTrue($type->isMixed());
    }

    public function testIsNumeric(): void
    {
        $type = Type::Int;
        $this->assertTrue($type->isNumeric());
    }

    public function testIsScalar(): void
    {
        $type = Type::Bool;
        $this->assertTrue($type->isScalar());
    }

    public function testIsComplex(): void
    {
        $type = Type::Object;
        $this->assertTrue($type->isComplex());
    }

    public function testIsArrayLike(): void
    {
        $type = Type::List;
        $this->assertTrue($type->isArrayLike());
    }

    public function testIsObjectLike(): void
    {
        $type = Type::Object;
        $this->assertTrue($type->isObjectLike());
    }
}
