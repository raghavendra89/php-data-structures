<?php

require 'Stack.php';

function stockSpan($stockValues)
{
    $stack = new Stack;
    $spanValues = [];
    while (! empty($stockValues)) {
        $stack->push(array_pop($stockValues));
    }

    // 2 temp stacks
    $stack1 = new Stack;
    $stack2 = new Stack;

    // Push to stack1
    while (! $stack->isEmpty()) {
        $current = $stack->pop();
        $span = 1;

        // Compare and move from stack1 to stack2, until greater value is found
        while (! $stack1->isEmpty()) {
            $previous = $stack1->pop();
            $stack2->push($previous);

            if ($previous <= $current) {
                $span++;
            } else {
                break;
            }
        }

        // Move back from stack2 to stack1
        while (! $stack2->isEmpty()) {
            $stack1->push($stack2->pop());
        }

        // Add the current comparing element
        $stack1->push($current);
        $spanValues[] = $span;
    }

    return $spanValues;
}

print_r(stockSpan([100, 80, 60, 70, 60, 75, 85])); // 1 1 1 2 1 4 6
print_r(stockSpan([10, 4, 5, 90, 120, 80])); // 1 1 2 4 5 1

