# Ahungry Powerset

This is a PHP package that allows you to generate a power set
(enumerate all possible values) of a multi-dimensional array.

## Installation
Watch for this to be available on packagist, at which point you can
install with (update: its on packagist now!):

```
composer require ahungry/powerset
```

But in the meantime, to install, clone the repository via:

```
git clone https://github.com/ahungry/ahungry-powerset.git
```

and include the file, or add a new VCS reference in your
composer.json as such:

```json
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/ahungry/ahungry-powerset"
        }
    ],
    "require": {
        "ahungry/powerset": "^0.1"
    }
```

then follow it up with a:

```
composer update
```


### Using ahungry-powerset

After requiring it (or auto-loading it with composer), you can use it
(see blub.php for a sample) via:

```php
use Com\Ahungry\Powerset\Functions as pset;

$b = [[
    'a' => [1,2],
    'b' => [3,4],
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
            [a] => 2
            [b] => 4
        )

    [1] => Array
        (
            [a] => 2
            [b] => 3
        )

    [2] => Array
        (
            [a] => 1
            [b] => 4
        )

    [3] => Array
        (
            [a] => 1
            [b] => 3
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

- Get package listed on packagist

- Generate a true power set (include the empty value possibilities)

## License
GPLv3
