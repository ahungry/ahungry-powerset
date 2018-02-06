<?php
/**
 *  functions.php --- Generate a powerset for a multi-dimensional array
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
namespace Com\Ahungry\Powerset\Functions;

function expandElement(array $data, array &$result = [])
{
    foreach ($data as $k => $v) {
        if (is_array($v) && !empty($v) && is_numeric(key($v))) {
            $tmp = $data;
            $tmp[$k] = array_pop($v);
            $data[$k] = $v;
            $result[] = $tmp;

            if (!empty($v)) {
                expandElement($data, $result);
            }

            break;
        } elseif (is_array($v) && !empty($v)) {
            $node = [];
            expandElement($v, $node);

            if (!empty($node)) {
                $data[$k] = $node;
                $result[] = $data;
            }
        }
    }
}

function powerSet(array &$result)
{
    // De-duplicate entries that are identical
    $found = [];
    foreach ($result as $key => $value) {
        if (!in_array($value, $found)) {
            $found[] = $value;
        }
    }
    $result = $found;

    $result = array_reduce($result, function ($carry = [], $set) {
        $result = [];
        expandElement($set, $result);

        return array_merge($carry, $result);
    }, []);

    if (hasArrayElement($result)) {
        powerSet($result);
    }
}

function hasArrayElement(array $haystack)
{
    $found = false;

    foreach ($haystack as $val) {
        hasAutoKey($val, $found);
    }

    return $found;
}

function hasAutoKey(array $haystack, &$found)
{
    foreach ($haystack as $k => $v) {
        if (is_numeric($k)) {
            $found = true;
        }

        if (is_array($v)) {
            hasAutoKey($v, $found);
        }
    }
}
