<?php

// Given two expressions in the form of strings. The task is to compare them and check if they are similar. Expressions consist of lowercase alphabets, ‘+’, ‘-‘ and ‘( )’.

require 'Stack.php';

function getNumber($char)
{
    if (preg_match('/^[a-zA-Z]$/', $char)) {
        return ord($char);
    }

    return (int) $char;
}

function evaluate($expression)
{
    $result = 0;
    if (! in_array($expression[0], ['+', '-'])) {
        $result = getNumber($expression[0]);
    }

    for ($i=0; $i < strlen($expression); $i++) {
        switch ($expression[$i]) {
            case '+':
                $nextOperand = preg_split('/(\+|\-)/', substr($expression, $i + 1))[0];
                $result += getNumber($nextOperand);
                break;

            case '-':
                $nextOperand = preg_split('/(\+|\-)/', substr($expression, $i + 1))[0];
                $result -= getNumber($nextOperand);
                break;
        }
    }

    return $result;
}

function evaluateCompleteExpression($expression)
{
    $startIndex = 0;
    $endIndex = 0;
    $stack = new Stack;

    while (strpos($expression, '(')) {
        for ($i=0; $i < strlen($expression); $i++) {
            if ($expression[$i] == '(') {
                $startIndex = $i + 1;
                $stack->push($i);
            }

            if ($expression[$i] == ')') {
                $endIndex = $i;
                $startIndex = $stack->pop();

                // Evaluate the inner parenthesis expression
                $result = evaluate(substr($expression, $startIndex + 1, ($endIndex - $startIndex - 1)));

                $previous = ($startIndex > 1) ? $startIndex - 1 : 0;
                // Change the sing only if the previous value is negative
                if ($expression[$previous] == '-') {
                    $result = ($result < 0) ? '+' . abs($result) : -$result;
                }

                $substringStartIndex = $startIndex;
                if (in_array($expression[$previous], ['+', '-'])) {
                    $substringStartIndex = $startIndex - 1;
                }

                $expression = substr($expression, 0, $substringStartIndex)
                                        . $result
                                        . substr($expression, $endIndex + 1, strlen($expression) - ($endIndex + 1));

                break;
            }
        }
    }


    return evaluate($expression);
}

function areSame($expression1, $expression2)
{
    if (evaluateCompleteExpression($expression1) == evaluateCompleteExpression($expression2)) {
        return 'YES';
    }
    return 'NO';
}

print_r(areSame('-(a+b+c)', '-a-b-c') . PHP_EOL); // YES
print_r(areSame('-(c+b+a)', '-c-b-a') . PHP_EOL); // YES
print_r(areSame('a-b-(c-d)', 'a-b-c-d') . PHP_EOL); // NO
print_r(areSame('a-(b-(c-d))', 'a-b-c-d') . PHP_EOL); // NO
print_r(areSame('a-b-(c-d)', 'a-b-c+d') . PHP_EOL); // YES
print_r(areSame('a-(b-(c-d))', 'a-b+c-d') . PHP_EOL); // YES
