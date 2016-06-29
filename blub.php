<?php

namespace Blub;

require __DIR__ . '/vendor/autoload.php';

use Com\Ahungry\Powerset\Functions as pset;

$a = [
  [
    [1,2],
    [3,4],
  ]
];

pset\powerSet($a);

print_r($a);