<?php

// Algorithm:

// Create a temporary stack say tmpStack.
// While input stack is NOT empty do this: 
    // Pop an element from input stack call it temp
    // while temporary stack is NOT empty and top of temporary stack is greater than temp, 
    // pop from temporary stack and push it to the input stack
    // push temp in temporary stack
// The sorted numbers are in tmpStack

require 'Stack.php';

function sortStack($array)
{
    $stack = new Stack;
    while (! empty($array)) {
        $stack->push(array_pop($array));
    }

    $tmpStack = new Stack;
    while (! $stack->isEmpty()) {
        $temp = $stack->pop();

        while (! $tmpStack->isEmpty() && $tmpStack->top() < $temp) {
            $stack->push($tmpStack->pop());
        }

        $tmpStack->push($temp);
    }

    $sortedArray = [];
    while (! $tmpStack->isEmpty()) {
        $sortedArray[] = $tmpStack->pop();
    }

    return $sortedArray;
}

print_r(sortStack([34, 3, 31, 98, 92, 23])); // [3, 23, 31, 34, 92, 98]
print_r(sortStack([3, 5, 1, 4, 2, 8])); // [1, 2, 3, 4, 5, 8] 
