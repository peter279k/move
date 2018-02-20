Move
====

Implements one-time access similar to Rust's move semantics.

Usage
-----

```php
use KHerGe\Rust\Move;

$value = new Move(123);

echo 'Value: ', $value->move(), "\n";

$inner = $value->move(); // throws RuntimeException
```

Requirements
------------

- PHP 7.0 or greater

Installation
------------

    composer require kherge/move

License
-------

This library is available under the Apache 2.0 and MIT licenses.