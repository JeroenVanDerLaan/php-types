<?php

declare(strict_types=1);

namespace Jeroenvanderlaan\Types\Tests;

use Jeroenvanderlaan\Types\Inflector;
use Jeroenvanderlaan\Types\Type;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;
use stdClass;

#[CoversClass(Inflector::class)]
#[UsesClass(Type::class)]
class InflectorTest extends TestCase
{
    public function testGetTypeOfNull(): void
    {
        $type = Inflector::getTypeOf(null);
        $this->assertEquals(Type::Null, $type);
    }

    public function testGetTypeOfBool(): void
    {
        $type = Inflector::getTypeOf(true);
        $this->assertEquals(Type::Bool, $type);
    }

    public function testGetTypeOfInt(): void
    {
        $type = Inflector::getTypeOf(1);
        $this->assertEquals(Type::Int, $type);
    }

    public function testGetTypeOfFloat(): void
    {
        $type = Inflector::getTypeOf(1.0);
        $this->assertEquals(Type::Float, $type);
    }

    public function testGetTypeOfNumber(): void
    {
        $type = Inflector::getTypeOf('1.0');
        $this->assertEquals(Type::Number, $type);
    }

    public function testGetTypeOfString(): void
    {
        $type = Inflector::getTypeOf('string');
        $this->assertEquals(Type::String, $type);
    }

//    public function testGetTypeOfScalar(): void
//    {
//        $type = Inflector::getTypeOf(1);
//        $this->assertTrue($type->isEqualTo(Type::Scalar));
//    }

    public function testGetTypeOfResource(): void
    {
        $type = Inflector::getTypeOf(STDOUT);
        $this->assertEquals(Type::Resource, $type);
    }

    public function testGetTypeOfCallable(): void
    {
        $type = Inflector::getTypeOf(fn () => null);
        $this->assertEquals(Type::Callable, $type);
    }

    public function testGetTypeOfList(): void
    {
        $type = Inflector::getTypeOf([1, 2]);
        $this->assertEquals(Type::List, $type);
    }

    public function testGetTypeOfMap(): void
    {
        $type = Inflector::getTypeOf(['a' => 'b']);
        $this->assertEquals(Type::Map, $type);
    }

    public function testGetTypeOfArray(): void
    {
        $type = Inflector::getTypeOf([1, 'a' => 'b']);
        $this->assertEquals(Type::Array, $type);
    }

    public function testGetTypeOfIterable(): void
    {
        $type = Inflector::getTypeOf(new \ArrayIterator());
        $this->assertEquals(Type::Iterable, $type);
    }

    public function testGetTypeOfObject(): void
    {
        $type = Inflector::getTypeOf(new stdClass());
        $this->assertEquals(Type::Object, $type);
    }

    public function testGetIndexKeyTypes(): void
    {
        $type = Inflector::getKeyTypes([1, 2]);
        $this->assertEquals([Type::Int], $type);
    }

    public function testGetStringKeyTypes(): void
    {
        $type = Inflector::getKeyTypes(['a' => 'b']);
        $this->assertEquals([Type::String], $type);
    }

    public function testGetDynamicKeyTypes(): void
    {
        $type = Inflector::getKeyTypes([1, 'a' => 'b']);
        $this->assertEquals([Type::Int, Type::String], $type);
    }

    public function testGetDefaultKeyTypes(): void
    {
        $type = Inflector::getKeyTypes([]);
        $this->assertEquals([Type::Int, Type::String], $type);
    }

    public function testGetElementTypes(): void
    {
        $type = Inflector::getElementTypes([1, 'a']);
        $this->assertEquals([Type::Int, Type::String], $type);
    }

    public function testGetDefaultElementTypes(): void
    {
        $type = Inflector::getElementTypes([]);
        $this->assertEquals([Type::Mixed], $type);
    }

    public function testGetUnionTypes(): void
    {
        $type = Inflector::getUnionTypes('int|string');
        $this->assertEquals([Type::Int, Type::String], $type);
    }
}
