<?php

require 'Stack.php';

function longestValidParenthesis($string)
{
    $stack = new Stack;
    $length = 0;
    $startIndex = 0;
    $validParenthesis = [];

    for ($i=0; $i < strlen($string); $i++) { 
        if ($string[$i] == '(') {
            $stack->push('(');
            $startIndex++;
        } else {
            if (! $stack->isEmpty()) {
                $stack->pop();
                $length += 2;
                $startIndex--;
            } else {
                $startIndex = $i + 1;
                $length = 0;
            }
        }

        $validParenthesis[$startIndex]  = $length;
    }

    $maxLength = max($validParenthesis);
    $maxStringStart = array_search($maxLength, $validParenthesis);
    return $maxLength . '-' . substr($string, $maxStringStart, $maxLength);
}

print_r(longestValidParenthesis('(') . PHP_EOL); // 0 - 
print_r(longestValidParenthesis(')') . PHP_EOL); // 0 - 
print_r(longestValidParenthesis('))') . PHP_EOL); // 0 - 
print_r(longestValidParenthesis('))()') . PHP_EOL); // 2 - 
print_r(longestValidParenthesis('(()') . PHP_EOL); // 2 - ()
print_r(longestValidParenthesis('()()') . PHP_EOL); // 4 - ()()
print_r(longestValidParenthesis(')()())') . PHP_EOL); // 4 - ()()
print_r(longestValidParenthesis('())()())') . PHP_EOL); // 4 - ()()
print_r(longestValidParenthesis('(()())') . PHP_EOL); // 6 - (()())
print_r(longestValidParenthesis('((())())') . PHP_EOL); // 8 - ((())())
print_r(longestValidParenthesis(')()())((())())') . PHP_EOL); // 8 - ((())())
print_r(longestValidParenthesis(')()())(()()())') . PHP_EOL); // 8 - (()()())
