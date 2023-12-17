<?php

declare(strict_types=1);

namespace Jeroenvanderlaan\Types\Tests;

use Jeroenvanderlaan\Types\Formatter;
use Jeroenvanderlaan\Types\Type;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;
use stdClass;

#[CoversClass(Formatter::class)]
#[UsesClass(Type::class)]
class FormatterTest extends TestCase
{
    public function testFormatTypeOfNull(): void
    {
        $type = Formatter::formatTypeOf(null);
        $this->assertEquals(Type::Null->value, $type);
    }

    public function testFormatTypeOfBool(): void
    {
        $type = Formatter::formatTypeOf(true);
        $this->assertEquals(Type::Bool->value, $type);
    }

    public function testFormatTypeOfInt(): void
    {
        $type = Formatter::formatTypeOf(1);
        $this->assertEquals(Type::Int->value, $type);
    }

    public function testFormatTypeOfFloat(): void
    {
        $type = Formatter::formatTypeOf(1.0);
        $this->assertEquals(Type::Float->value, $type);
    }

    public function testFormatTypeOfNumber(): void
    {
        $type = Formatter::formatTypeOf('1.0');
        $this->assertEquals(Type::Number->value, $type);
    }

    public function testFormatTypeOfString(): void
    {
        $type = Formatter::formatTypeOf('string');
        $this->assertEquals(Type::String->value, $type);
    }

//    public function testFormatTypeOfScalar(): void
//    {
//        $type = Formatter::formatTypeOf(1);
//        $this->assertEquals(Type::Scalar->value, $type);
//    }

    public function testFormatTypeOfResource(): void
    {
        $type = Formatter::formatTypeOf(STDOUT);
        $this->assertEquals(Type::Resource->value, $type);
    }

    public function testFormatTypeOfCallable(): void
    {
        $type = Formatter::formatTypeOf(fn() => null);
        $this->assertEquals(Type::Callable->value, $type);
    }

//    public function testFormatTypeOfMixed(): void
//    {
//        $type = Formatter::formatTypeOf('');
//        $this->assertEquals(Type::Mixed->value, $type);
//    }

    public function testFormatTypeOfObject(): void
    {
        $type = Formatter::formatTypeOf(new stdClass());
        $this->assertEquals(stdClass::class, $type);
    }

    public function testFormatTypeOfList(): void
    {
        $type = Formatter::formatTypeOf([1, 2]);
        $this->assertEquals('list<int>', $type);
    }

    public function testFormatTypeOfMap(): void
    {
        $type = Formatter::formatTypeOf(['a' => 'b']);
        $this->assertEquals('map<string>', $type);
    }

    public function testFormatTypeOfArray(): void
    {
        $type = Formatter::formatTypeOf([1, 'a' => 'b']);
        $this->assertEquals('array<int|string>', $type);
    }

    public function testFormatTypeOfTraversable(): void
    {
        $type = Formatter::formatTypeOf(new \ArrayIterator([1, 2]));
        $this->assertEquals('ArrayIterator<int>', $type);
    }

    public function testFormatKeyTypes(): void
    {
        $type = Formatter::formatKeyTypes([1, 'a' => 'b']);
        $this->assertEquals('int|string', $type);
    }

    public function testFormatDefaultKeyTypes(): void
    {
        $type = Formatter::formatKeyTypes([]);
        $this->assertEquals('int|string', $type);
    }

    public function testFormatElementTypes(): void
    {
        $type = Formatter::formatElementTypes([1, 'a' => 'b']);
        $this->assertEquals('int|string', $type);
    }

    public function testFormatDefaultElementTypes(): void
    {
        $type = Formatter::formatElementTypes([]);
        $this->assertEquals(Type::Mixed->value, $type);
    }

    public function testFormatUnionTypes(): void
    {
        $type = Formatter::formatUnionTypes(Type::Int, Type::String);
        $this->assertEquals('int|string', $type);
    }

    public function testFormatDefaultUnionTypes(): void
    {
        $type = Formatter::formatUnionTypes();
        $this->assertEquals(Type::Mixed->value, $type);
    }
}
