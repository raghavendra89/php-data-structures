<?php

// Given a string S, the task is to find the lexicographically largest subsequence that can be formed using all distinct characters only once from the given string.
// Input: S = ababc
// Output: bac
// Explanation: All possible subsequences containing all the characters in S exactly once are {“abc”, “bac”}. The lexicographically maximum among all the subsequences  is “bac”.

require 'Stack.php';

function lexicographicallyLargestSubsequence($string)
{
    $visited = [];
    $count = [];
    $stack = new Stack;

    // Findthe number of occurrences of the characters
    for ($i=0; $i < strlen($string); $i++) {
        if (empty($count[$string[$i]])) {
            $count[$string[$i]] = 0;
        }

        $count[$string[$i]] += 1;
    }

    for ($i=0; $i < strlen($string); $i++) {
        $char = $string[$i];
        // Decrease the character count in remaining string
        $count[$char]--;

        // If character is already present in the stack
        if (! empty($visited[$char]) && $visited[$char] > 0) {
            continue;
        }

        // if current character is greater than last character in stack
        // then pop the top character
        while (! $stack->isEmpty() && $stack->top() < $char && $count[$stack->top()] != 0) {
            $visited[$stack->top()] = 0;
            $stack->pop();
        }

        // Push the current character
        $stack->push($char);
        $visited[$char] = 1;
    }

    $result = '';
    while (! $stack->isEmpty()) {
        $result = $stack->pop() . $result;
    }

    return $result;
}

print_r(lexicographicallyLargestSubsequence('ababc'). PHP_EOL); //  bac
print_r(lexicographicallyLargestSubsequence('zydsbacab'). PHP_EOL); //  zydscab
