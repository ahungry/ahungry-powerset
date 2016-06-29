<?php

namespace com\ahungry\Powerset;

function hasArrayElement($data) {
    if (!is_array($data)) {
        return false;
    }

    foreach ($data as $element) {
        if (!is_array($element)) {
            return false;
        }

        foreach ($element as $key => $value) {
            if (is_array($value) && is_numeric(key($value))) {
                return true;
            } elseif (is_array($value)) {
                foreach ($value as $ik => $iv) {
                    if (hasArrayElement($iv)) {
                        return true;
                    }
                }
            }
        }
    }

    return false;
}

function expandElement($data, &$result = [])
{
    foreach ($data as $k => $v) {
        if (is_array($v) && !empty($v) && is_numeric(key($v))) {
            $tmp = $data;
            $tmp[$k] = array_pop($v);
            $data[$k] = $v;
            $result[] = $tmp;

            if (!empty ($v)) {
                expandElement($data, $result);
            }

            break;
        } elseif (is_array($v) && !empty($v)) {
            $node = [];
            expandElement($v, $node);

            if (!empty ($node)) {
                $data[$k] = $node;
                $result[] = $data;
            }
        }
    }
}

function powerSet(&$result)
{
    $result = array_reduce($result, function ($carry = [], $set) {
        expandElement($set, $result);

        return $result === null ? $carry : array_merge($carry, $result);
    }, []);

    if (hasArrayElement($result)) {
        powerSet($result);
    }
}

$a = [[
    'a' => 0,
    'x' => [
        ['b' => 1, 'c' => ['a', 'b', 'c']],
        ['b' => 3, 'c' => ['a', 'b', 'c']],
        ['b' => 5, 'c' => ['a', 'b', 'c']],
    ],
    'y' => [7, 8, 9],
]];

// expect this?
$b = [[
    [1,2],
    [3,4],
]];

powerSet($a);
powerSet($b);

var_dump ($b);
var_dump ($a);
