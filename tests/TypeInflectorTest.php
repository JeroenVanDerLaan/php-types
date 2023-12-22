<?php

declare(strict_types=1);

namespace Jeroenvanderlaan\Types\Tests;

use Jeroenvanderlaan\Types\TypeInflector;
use Jeroenvanderlaan\Types\Type;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;
use stdClass;

#[CoversClass(TypeInflector::class)]
#[UsesClass(Type::class)]
class TypeInflectorTest extends TestCase
{
    public function testGetTypeOfNull(): void
    {
        $type = TypeInflector::typeof(null);
        $this->assertEquals(Type::Null, $type);
    }

    public function testGetTypeOfBool(): void
    {
        $type = TypeInflector::typeof(true);
        $this->assertEquals(Type::Bool, $type);
    }

    public function testGetTypeOfInt(): void
    {
        $type = TypeInflector::typeof(1);
        $this->assertEquals(Type::Int, $type);
    }

    public function testGetTypeOfFloat(): void
    {
        $type = TypeInflector::typeof(1.0);
        $this->assertEquals(Type::Float, $type);
    }

    public function testGetTypeOfNumber(): void
    {
        $type = TypeInflector::typeof('1.0');
        $this->assertEquals(Type::Number, $type);
    }

    public function testGetTypeOfString(): void
    {
        $type = TypeInflector::typeof('string');
        $this->assertEquals(Type::String, $type);
    }

//    public function testGetTypeOfScalar(): void
//    {
//        $type = Inflector::getTypeOf(1);
//        $this->assertTrue($type->isEqualTo(Type::Scalar));
//    }

    public function testGetTypeOfResource(): void
    {
        $type = TypeInflector::typeof(STDOUT);
        $this->assertEquals(Type::Resource, $type);
    }

    public function testGetTypeOfCallable(): void
    {
        $type = TypeInflector::typeof(fn () => null);
        $this->assertEquals(Type::Callable, $type);
    }

    public function testGetTypeOfList(): void
    {
        $type = TypeInflector::typeof([1, 2]);
        $this->assertEquals(Type::List, $type);
    }

    public function testGetTypeOfMap(): void
    {
        $type = TypeInflector::typeof(['a' => 'b']);
        $this->assertEquals(Type::Map, $type);
    }

    public function testGetTypeOfArray(): void
    {
        $type = TypeInflector::typeof([1, 'a' => 'b']);
        $this->assertEquals(Type::Array, $type);
    }

    public function testGetTypeOfIterable(): void
    {
        $type = TypeInflector::typeof(new \ArrayIterator());
        $this->assertEquals(Type::Iterable, $type);
    }

    public function testGetTypeOfObject(): void
    {
        $type = TypeInflector::typeof(new stdClass());
        $this->assertEquals(Type::Object, $type);
    }

    public function testGetIndexKeyTypes(): void
    {
        $type = TypeInflector::getKeyTypes([1, 2]);
        $this->assertEquals([Type::Int], $type);
    }

    public function testGetStringKeyTypes(): void
    {
        $type = TypeInflector::getKeyTypes(['a' => 'b']);
        $this->assertEquals([Type::String], $type);
    }

    public function testGetDynamicKeyTypes(): void
    {
        $type = TypeInflector::getKeyTypes([1, 'a' => 'b']);
        $this->assertEquals([Type::Int, Type::String], $type);
    }

    public function testGetDefaultKeyTypes(): void
    {
        $type = TypeInflector::getKeyTypes([]);
        $this->assertEquals([Type::Int, Type::String], $type);
    }

    public function testGetElementTypes(): void
    {
        $type = TypeInflector::getElementTypes([1, 'a']);
        $this->assertEquals([Type::Int, Type::String], $type);
    }

    public function testGetDefaultElementTypes(): void
    {
        $type = TypeInflector::getElementTypes([]);
        $this->assertEquals([Type::Mixed], $type);
    }
}
