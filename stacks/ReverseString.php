<?php

// Reverse a String using Stack

require 'Stack.php';

function reverseString($string)
{
    $stack = new Stack;
    for ($i=0; $i < strlen($string); $i++) { 
        $stack->push($string[$i]);
    }

    $reversedString = '';
    while (!$stack->isEmpty()) {
        $reversedString .= $stack->pop();
    }

    return $reversedString;
}

print_r(reverseString('GeeksQuiz') . PHP_EOL); // ziuQskeeG
print_r(reverseString('homefoo') . PHP_EOL); // oofemoh