<?php

namespace Com\Ahungry\Powerset\Functions\Test;

require __DIR__ . '/../Functions.php';

use Com\Ahungry\Powerset\Functions as ps;

class FunctionsTest extends \PHPUnit_Framework_TestCase {
  /**
   * Test that our sets generate successfully
   */
  public function testPowerset()
  {
    $b = [[
        [1,2],
        [3,4],
      ]];

    ps\powerSet($b);
    $this->assertCount(4, $b);

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
    $this->assertCount(27, $a);
  }
}