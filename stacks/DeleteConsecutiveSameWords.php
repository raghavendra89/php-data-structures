<?php

// Given a sequence of n strings, the task is to check if any two similar words come together and then destroy each other then print the number of words left in the sequence after this pairwise destruction.

require 'Stack.php';

function deleteConsecutiveSameWords($string)
{
    $words = explode(' ', $string);

    $stack = new Stack;
    foreach ($words as $word) {
        if (! $stack->isEmpty()) {
            if ($word == $stack->top()) {
                $stack->pop();
            } else {
                $stack->push($word);
            }
        } else {
            $stack->push($word);
        }
    }

    $count = 0;
    while (! $stack->isEmpty()) {
        $stack->pop();
        $count++;
    }

    return $count;
}

print_r(deleteConsecutiveSameWords('ab aa aa bcd ab')); // 3
print_r(deleteConsecutiveSameWords('tom jerry jerry tom')); // 0
print_r(deleteConsecutiveSameWords('spike tom jerry jerry tom spike')); // 0
print_r(deleteConsecutiveSameWords('spike tom jerry jerry spike tom')); // 4