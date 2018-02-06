<?php
/**
 *  FunctionsTest.php --- Test generating a powerset for a multi-dimensional array
 *
 *  Copyright (C) 2016  Matthew Carter
 *
 *  Author: Matthew Carter <m@ahungry.com>
 *  Maintainer: Matthew Carter <m@ahungry.com>
 *  URL: https://github.com/ahungry/ahungry-powerset
 *  Version: 0.0.1
 *
 *  License:
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *  Commentary:
 *
 *  A parser/converter to generate a powerset (enumerate all possible values)
 *  from a multi-dimensional array
 *
 *  News:
 *
 *  Changes since 0.0.0:
 *  - Created the project
 *
 *  Code:
 */
namespace Com\Ahungry\Powerset\Functions\Test;

require_once __DIR__ . '/../Functions.php';

use Com\Ahungry\Powerset\Functions as ps;

class FunctionsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test that our sets generate successfully
     */
    public function testPowerset()
    {
        $b = [[
                'a' => [1,2],
                'b' => [3,4],
            ]];

        ps\powerSet($b);
        print_r($b);
        $this->assertCount(4, $b);

        $a = [[
                'a' => 0,
                'x' => [
                    ['b' => 1, 'c' => [['a', 'b', 'c']]],
                    ['b' => 3, 'c' => [['a', 'b', 'c']]],
                    ['b' => 5, 'c' => [['a', 'b', 'c']]],
                ],
                'y' => [7, 8, 9],
            ]];

        ps\powerSet($a);
        $this->assertCount(27, $a);

        $veryNested = [[
                'first1' => [
                    [
                        'second1' => [
                            [
                                'third1' => ['not quite right...'],
                            ]
                        ],
                        'second2' => [
                            [
                                'third2' => ['fail'],
                            ]
                        ]
                    ]
                ],
            ]];

        ps\powerSet($veryNested);

        $expected = [[
            'first1' => [
                'second1' => [
                    'third1' => 'not quite right...',
                ],
                'second2' => [
                    'third2' => 'fail',
                ],
            ],
        ]];

        $this->assertCount(1, $veryNested);
        $this->assertEquals($expected, $veryNested);

        $veryNested = [[
                'first1' => [
                    [
                        'second1' => [
                            [
                                'third1' => 'not quite right...',
                            ]
                        ],
                        'second2' => [
                            [
                                'third2' => 'fail',
                            ]
                        ]
                    ]
                ],
            ]];

        ps\powerSet($veryNested);

        $expected = [[
            'first1' => [
                'second1' => [
                    'third1' => 'not quite right...',
                ],
                'second2' => [
                    'third2' => 'fail',
                ],
            ],
        ]];

        $this->assertCount(1, $veryNested);
        $this->assertEquals($expected, $veryNested);
    }
}
