# Ahungry Powerset

This is a PHP package that allows you to generate a power set
(enumerate all possible values) of a multi-dimensional array.

## Installation
Watch for this to be available on composer, at which point you can
install with:

```
composer require ahungry/powerset
```

But in the meantime, to install, clone the repository via:

```
git clone https://github.com/ahungry/ahungry-powerset.git
```

### Using ahungry-powerset

After requiring it, you can use it via:

```php
use Com\Ahungry\Powerset\Functions as pset;

$b = [[
    [1,2],
    [3,4],
]];

pset\powerSet($b);

print_r($b);
```

which will then produce the following output:

```php
Array
(
    [0] => Array
        (
            [0] => 2
            [1] => 4
        )

    [1] => Array
        (
            [0] => 2
            [1] => 3
        )

    [2] => Array
        (
            [0] => 1
            [1] => 4
        )

    [3] => Array
        (
            [0] => 1
            [1] => 3
        )

)
```

Oh, and it will work with nested arrays:

```php
    $a = [[
        'a' => 0,
        'x' => [
          ['b' => 1, 'c' => ['a', 'b', 'c']],
          ['b' => 3, 'c' => ['a', 'b', 'c']],
          ['b' => 5, 'c' => ['a', 'b', 'c']],
        ],
        'y' => [7, 8, 9],
      ]];

    ps\powerSet($a);
    $this->assertCount(27, $a); // true
```

## TODO

- Get package listed on composer

- Generate a true power set (include the empty value possibilities)

## License
GPLv3