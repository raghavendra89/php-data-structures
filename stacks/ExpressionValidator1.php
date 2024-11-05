<?php

require 'Stack.php';

function isValidExpression($expression) {
    if (empty($expression)) {
        return "True";
    }

    $stack = new Stack;
    $mapping = [')' => '(', ']' => '[', '}' => '{'];

    for ($i=0; $i < strlen($expression); $i++) { 
        $char = $expression[$i];
        $charToMatch = $mapping[$char] ?? null;

        if ($charToMatch !== null) {
            if ($stack->isEmpty() || $stack->pop() !== $charToMatch) {
                return "False";
            }
        } else {
            if (in_array($char, $mapping)) {
                $stack->push($char);
            }
        }
    }

    return $stack->isEmpty() ? "True" : "False";
}

print_r(isValidExpression('()') . PHP_EOL); // True
print_r(isValidExpression('{[()]}') . PHP_EOL); // True
print_r(isValidExpression('[5 * (6 + 7)]') . PHP_EOL); // True
print_r(isValidExpression('[5 * (6 + 7])') . PHP_EOL); // False
print_r(isValidExpression('5 + [7 * (8 + 5])') . PHP_EOL); // False
