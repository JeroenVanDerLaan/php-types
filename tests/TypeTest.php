<?php

declare(strict_types=1);

namespace Jeroenvanderlaan\Types\Tests;

use Jeroenvanderlaan\Types\Type;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Type::class)]
class TypeTest extends TestCase
{
    public function testGetNull(): void
    {
        $type = Type::get('null');
        $this->assertEquals(Type::Null, $type);
    }

    public function testGetBool(): void
    {
        $type = Type::get('bool');
        $this->assertEquals(Type::Bool, $type);
    }

    public function testGetInt(): void
    {
        $type = Type::get('int');
        $this->assertEquals(Type::Int, $type);
    }

    public function testGetFloat(): void
    {
        $type = Type::get('float');
        $this->assertEquals(Type::Float, $type);
    }

    public function testGetNumber(): void
    {
        $type = Type::get('number');
        $this->assertEquals(Type::Number, $type);
    }

    public function testGetString(): void
    {
        $type = Type::get('string');
        $this->assertEquals(Type::String, $type);
    }

    public function testGetScalar(): void
    {
        $type = Type::get('scalar');
        $this->assertEquals(Type::Scalar, $type);
    }

    public function testGetResource(): void
    {
        $type = Type::get('resource');
        $this->assertEquals(Type::Resource, $type);
    }

    public function testGetCallable(): void
    {
        $type = Type::get('callable');
        $this->assertEquals(Type::Callable, $type);
    }

    public function testGetList(): void
    {
        $type = Type::get('list');
        $this->assertEquals(Type::List, $type);
    }

    public function testGetMap(): void
    {
        $type = Type::get('map');
        $this->assertEquals(Type::Map, $type);
    }

    public function testGetArray(): void
    {
        $type = Type::get('array');
        $this->assertEquals(Type::Array, $type);
    }

    public function testGetIterable(): void
    {
        $type = Type::get('iterable');
        $this->assertEquals(Type::Iterable, $type);
    }

    public function testGetObject(): void
    {
        $type = Type::get('object');
        $this->assertEquals(Type::Object, $type);
    }

    public function testGetMixed(): void
    {
        $type = Type::get('mixed');
        $this->assertEquals(Type::Mixed, $type);
    }

    public function testGetInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        Type::get('invalid');
    }

    public function testParse(): void
    {
        $type = Type::parse('int|string');
        $this->assertEquals([Type::Int, Type::String], $type);
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

    public function testIsCastableToScalar(): void
    {
        $type = Type::Int;
        $this->assertTrue($type->isCastableTo(Type::Number));
    }

    public function testIsCastableToArray(): void
    {
        $type = Type::Iterable;
        $this->assertTrue($type->isCastableTo(Type::Array));
    }

    public function testIsNotCastableTo(): void
    {
        $type = Type::Iterable;
        $this->assertFalse($type->isCastableTo(Type::Bool));
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
