<?php

// Delete middle element of a stack

require 'Stack.php';

function deleteMiddleElement($array)
{
    $stack = new Stack;

    foreach ($array as $value) {
        $stack->push($value);
    }

    $newArray = [];
    $count = 0;
    while (! $stack->isEmpty()) {
        array_unshift($newArray, $stack->pop());
        $count++;
    }

    $middleIndex = round($count / 2) - 1;
    unset($newArray[$middleIndex]);
    return array_values($newArray);
}

print_r(deleteMiddleElement([1, 2, 3, 4, 5])); // [1, 2, 4, 5]
print_r(deleteMiddleElement([1, 2, 3, 4, 5, 6])); // [1, 2, 4, 5, 6]