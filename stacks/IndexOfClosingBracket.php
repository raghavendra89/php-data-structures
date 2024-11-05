<?php

// Given a string with brackets. If the start index of the open bracket is given, find the index of the closing bracket.

require 'Stack.php';

function findIndexOfClosingBracket($string, $startIndex)
{
    $stack = new Stack;
    $endIndex = -1;

    for ($i=$startIndex; $i < strlen($string); $i++) {
        if ($string[$i] == '[') {
            $stack->push('[');
        }

        if ($string[$i] == ']') {
            $stack->pop();

            if ($stack->isEmpty()) {
                $endIndex = $i;
                break;
            }
        }
    }

    return $endIndex;
}

print_r(findIndexOfClosingBracket('[ABC[23]][89]', 0) . PHP_EOL); // 8
print_r(findIndexOfClosingBracket('[ABC[23]][89]', 4) . PHP_EOL); // 7
print_r(findIndexOfClosingBracket('[ABC[23]][89]', 9) . PHP_EOL); // 12