# PHP Types

Utilities for working with and formatting PHP types.

```php
use Jeroenvanderlaan\Types\Type;
use Jeroenvanderlaan\Types\TypeFormatter;
use Jeroenvanderlaan\Types\TypeInflector;

Type::get('float')->isCastableTo(Type::Int); // true

TypeInflector::typeof('John'); // Type::String

TypeFormatter::formatTypeOf([1, 2, 'a', 'b']); // 'list<int|string>'
```

## Installation

```bash
composer require jeroenvanderlaan/php-types
```

## Usage

```php
use Jeroenvanderlaan\Types\Type;
use Jeroenvanderlaan\Types\TypeFormatter;
use Jeroenvanderlaan\Types\TypeInflector;

// Get a Type by name or alias
Type::get('int'); // Type::Int
Type::get('integer'); // Type::Int

// Parse union Types
Type::parse('int|float'); // [Type::Int, Type::Float]

// Inflect a Type from a value
TypeInflector::typeof('foobar'); // Type::String
TypeInflector::typeof([1, 2]); // Type::List
TypeInflector::typeof(['a' => 'b'])); // Type::Map

// Format a Type
TypeFormatter::formatType(Type::Int); // 'int'
TypeFormatter::formatType(Type::Int, Type::Float); // 'int|float'

// Format the Type of value
TypeFormatter::formatTypeOf(1); // 'int'
TypeFormatter::formatTypeOf([1, 'a']); // 'list<int|string>'
TypeFormatter::formatTypeOf([['a'], ['b']]); // 'list<list<string>>'
TypeFormatter::formatTypeOf(new stdClass); // 'stdClass'
```

## Examples

```php
use Jeroenvanderlaan\Types\Type;
use Jeroenvanderlaan\Types\TypeFormatter;
use Jeroenvanderlaan\Types\TypeInflector;

Type::get('null'); // Type::Null
Type::get('bool'); // Type::Bool
Type::get('int'); // Type::Int
Type::get('float'); // Type::Float
Type::get('number'); // Type::Number
Type::get('string'); // Type::String
Type::get('scalar'); // Type::Scalar
Type::get('resource'); // Type::Resource
Type::get('callable'); // Type::Callable
Type::get('object'); // Type::Object
Type::get('list'); // Type::List
Type::get('map'); // Type::Map
Type::get('array'); // Type::Array
Type::get('iterable'); // Type::Iterable

TypeInflector::typeof(null); // Type::Null
TypeInflector::typeof(true); // Type::Bool
TypeInflector::typeof(1); // Type::Int
TypeInflector::typeof(1.0); // Type::Float
TypeInflector::typeof('1.0'); // Type::Number
TypeInflector::typeof('John'); // Type::String
TypeInflector::typeof(STDOUT); // Type::Resource
TypeInflector::typeof(fn() => null); // Type::Callable
TypeInflector::typeof(new stdClass()); // Type::Object
TypeInflector::typeof([1, 2]); // Type::List
TypeInflector::typeof(['a' => 'b']); // Type::Map
TypeInflector::typeof([1, 'a' => 'b']); // Type::Array
TypeInflector::typeof(new ArrayIterator([1, 2])); // Type::Iterable

TypeFormatter::formatTypeOf(null); // 'null'
TypeFormatter::formatTypeOf(true); // 'bool'
TypeFormatter::formatTypeOf(1); // 'int'
TypeFormatter::formatTypeOf(1.0); // 'float'
TypeFormatter::formatTypeOf('1.0'); // 'number'
TypeFormatter::formatTypeOf('John'); // 'string'
TypeFormatter::formatTypeOf(STDOUT); // 'resource'
TypeFormatter::formatTypeOf(fn() => null); // 'callable'
TypeFormatter::formatTypeOf(new stdClass()); // 'stdClass
TypeFormatter::formatTypeOf([1, 2]); // 'list<int>'
TypeFormatter::formatTypeOf([true, 1, 1.0, '1.0']); // 'list<bool|int|float|string>'
TypeFormatter::formatTypeOf(['a' => 'b']); // 'map<string>'
TypeFormatter::formatTypeOf(['a' => 'b', 'b' => 1]); // 'map<string|int>'
TypeFormatter::formatTypeOf([1, 'a' => 'b']); // 'array<int|string>'
TypeFormatter::formatTypeOf(new ArrayIterator([1, 2])); // 'ArrayIterator<int>'

Type::Bool->isEqualTo(Type::Bool); // true
Type::Int->isOneOf(Type::Int, Type::Float); // true
Type::Int->isCastableTo(Type::Float); // true
Type::Mixed->isMixed(); // true
Type::Number->isNumeric(); // true
Type::String->isScalar(); // true
Type::Resource->isComplex(); // true
Type::Iterable->isArrayLike(); // true
Type::Map->isObjectLike(); // true
```
