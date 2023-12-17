# PHP Types

Inflects and formats any given PHP value using a `Type` enumeration.

```php
use Jeroenvanderlaan\Types\Formatter;
use Jeroenvanderlaan\Types\Inflector;
use Jeroenvanderlaan\Types\Type;

Type::resolve('integer'); // Type::Int
Inflector::getTypeOf(['a' => 'b'])); // Type::Map
Formatter::formatTypeOf([1, 'a']); // 'list<int|string>'
```

## Installation

```bash
composer require jeroenvanderlaan/php-types
```

## Usage

```php
use Jeroenvanderlaan\Types\Formatter;
use Jeroenvanderlaan\Types\Inflector;
use Jeroenvanderlaan\Types\Type;

// Resolve a Type enumeration by name (or alias)
$null = Type::resolve('null');
$bool = Type::resolve('bool');
$int = Type::resolve('int');
$float = Type::resolve('float');
$number = Type::resolve('number');
$string = Type::resolve('string');
$scalar = Type::resolve('scalar');
$resource = Type::resolve('resource');
$callable = Type::resolve('callable');
$object = Type::resolve('object');
$list = Type::resolve('list');
$map = Type::resolve('map');
$array = Type::resolve('array');
$iterable = Type::resolve('iterable');

// Inflect Type enumeration from value
$null = Inflector::getTypeOf(null);
$bool = Inflector::getTypeOf(true);
$int = Inflector::getTypeOf(1);
$float = Inflector::getTypeOf(1.0);
$number = Inflector::getTypeOf('1.0');
$string = Inflector::getTypeOf('John');
$resource = Inflector::getTypeOf(STDOUT);
$callable = Inflector::getTypeOf(fn () => null);
$object = Inflector::getTypeOf(new stdClass());
$list = Inflector::getTypeOf([1, 2]);
$map = Inflector::getTypeOf(['a' => 'b']);
$array = Inflector::getTypeOf([1, 'a' => 'b']);
$iterable = Inflector::getTypeOf(new ArrayIterator([1, 2]));

// Format type of value
Formatter::formatTypeOf(null); // 'null'
Formatter::formatTypeOf(true); // 'bool'
Formatter::formatTypeOf(1); // 'int'
Formatter::formatTypeOf(1.0); // 'float'
Formatter::formatTypeOf('1.0'); // 'number'
Formatter::formatTypeOf('John'); // 'string'
Formatter::formatTypeOf(STDOUT); // 'resource'
Formatter::formatTypeOf(fn () => null); // 'callable'
Formatter::formatTypeOf(new stdClass()); // 'stdClass
Formatter::formatTypeOf([1, 2]); // 'list<int>'
Formatter::formatTypeOf([true, 1, 1.0, '1.0']); // 'list<bool|int|float|string>'
Formatter::formatTypeOf(['a' => 'b']); // 'map<string>'
Formatter::formatTypeOf(['a' => 'b', 'b' => 1]); // 'map<string|int>'
Formatter::formatTypeOf([1, 'a' => 'b']); // 'array<int|string>'
Formatter::formatTypeOf(new ArrayIterator([1, 2])); // 'ArrayIterator<int>'

// Work with union types
$types = Inflector::getUnionTypes('bool|int|string');
Formatter::formatUnionTypes(...$types); // 'bool|int|string'

// Apply type assertions
if (Type::Bool->isOneOf(...$types)) {
    $type = Type::Bool;
}
$value = '1000';
if (Inflector::getTypeOf($value)->isCoercedTo(Type::Int)) {
    $value = (int) $value;
}
$array = new ArrayIterator([1, 2]);
if (Inflector::getTypeOf($array)->isArrayLike()) {
    $array = (array) $array;
}
```
