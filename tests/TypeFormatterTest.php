<?php

declare(strict_types=1);

namespace Jeroenvanderlaan\Types\Tests;

use Jeroenvanderlaan\Types\TypeFormatter;
use Jeroenvanderlaan\Types\Type;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;
use stdClass;

#[CoversClass(TypeFormatter::class)]
#[UsesClass(Type::class)]
class TypeFormatterTest extends TestCase
{
    public function testFormatType(): void
    {
        $type = TypeFormatter::formatType(Type::Float);
        $this->assertEquals('float', $type);
    }

    public function testFormatUnionType(): void
    {
        $type = TypeFormatter::formatType(Type::Int, Type::String);
        $this->assertEquals('int|string', $type);
    }

    public function testFormatDefaultType(): void
    {
        $type = TypeFormatter::formatType();
        $this->assertEquals(Type::Mixed->value, $type);
    }

    public function testFormatTypeOfNull(): void
    {
        $type = TypeFormatter::formatTypeOf(null);
        $this->assertEquals(Type::Null->value, $type);
    }

    public function testFormatTypeOfBool(): void
    {
        $type = TypeFormatter::formatTypeOf(true);
        $this->assertEquals(Type::Bool->value, $type);
    }

    public function testFormatTypeOfInt(): void
    {
        $type = TypeFormatter::formatTypeOf(1);
        $this->assertEquals(Type::Int->value, $type);
    }

    public function testFormatTypeOfFloat(): void
    {
        $type = TypeFormatter::formatTypeOf(1.0);
        $this->assertEquals(Type::Float->value, $type);
    }

    public function testFormatTypeOfNumber(): void
    {
        $type = TypeFormatter::formatTypeOf('1.0');
        $this->assertEquals(Type::Number->value, $type);
    }

    public function testFormatTypeOfString(): void
    {
        $type = TypeFormatter::formatTypeOf('string');
        $this->assertEquals(Type::String->value, $type);
    }

//    public function testFormatTypeOfScalar(): void
//    {
//        $type = Formatter::formatTypeOf(1);
//        $this->assertEquals(Type::Scalar->value, $type);
//    }

    public function testFormatTypeOfResource(): void
    {
        $type = TypeFormatter::formatTypeOf(STDOUT);
        $this->assertEquals(Type::Resource->value, $type);
    }

    public function testFormatTypeOfCallable(): void
    {
        $type = TypeFormatter::formatTypeOf(fn() => null);
        $this->assertEquals(Type::Callable->value, $type);
    }

//    public function testFormatTypeOfMixed(): void
//    {
//        $type = Formatter::formatTypeOf('');
//        $this->assertEquals(Type::Mixed->value, $type);
//    }

    public function testFormatTypeOfObject(): void
    {
        $type = TypeFormatter::formatTypeOf(new stdClass());
        $this->assertEquals(stdClass::class, $type);
    }

    public function testFormatTypeOfList(): void
    {
        $type = TypeFormatter::formatTypeOf([1, 2]);
        $this->assertEquals('list<int>', $type);
    }

    public function testFormatTypeOfMap(): void
    {
        $type = TypeFormatter::formatTypeOf(['a' => 'b']);
        $this->assertEquals('map<string>', $type);
    }

    public function testFormatTypeOfArray(): void
    {
        $type = TypeFormatter::formatTypeOf([1, 'a' => 'b']);
        $this->assertEquals('array<int|string>', $type);
    }

    public function testFormatTypeOfTraversable(): void
    {
        $type = TypeFormatter::formatTypeOf(new \ArrayIterator([1, 2]));
        $this->assertEquals('ArrayIterator<int>', $type);
    }

    public function testFormatKeyTypes(): void
    {
        $type = TypeFormatter::formatTypeOfKeys([1, 'a' => 'b']);
        $this->assertEquals('int|string', $type);
    }

    public function testFormatDefaultKeyTypes(): void
    {
        $type = TypeFormatter::formatTypeOfKeys([]);
        $this->assertEquals('int|string', $type);
    }

    public function testFormatElementTypes(): void
    {
        $type = TypeFormatter::formatTypeOfElements([1, 'a' => 'b']);
        $this->assertEquals('int|string', $type);
    }

    public function testFormatDefaultElementTypes(): void
    {
        $type = TypeFormatter::formatTypeOfElements([]);
        $this->assertEquals(Type::Mixed->value, $type);
    }
}
