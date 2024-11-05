<?php

// We are given two arrays a[ ] and b[ ] of size n. All the elements of the array are unique. We have to create a function to check if the given array b[ ] is the stack permutation of given array a[ ] or not.
// Input: a[] = [ 1, 2, 3 ] , b[] = [ 2, 1, 3 ], Output: YES

require 'Stack.php';

function checkIfStackPermutation($array1, $array2)
{
    $inputStack = new Stack;
    $outputStack = new Stack;
    $tmpStack = new Stack;

    for ($i=count($array1) - 1; $i >= 0; $i--) { 
        $inputStack->push($array1[$i]);
    }

    for ($i=count($array2) - 1; $i >= 0; $i--) { 
        $outputStack->push($array2[$i]);
    }

    while (! $inputStack->isEmpty()) {
        $element = $inputStack->pop();
        $tmpStack->push($element);
        if ($element == $outputStack->top()) {

            while (! $tmpStack->isEmpty()) {
                if ($tmpStack->top() == $outputStack->top()) {
                    $tmpStack->pop();
                    $outputStack->pop();
                } else {
                    break;
                }
            }
        }
    }

    return ($tmpStack->isEmpty() && $inputStack->isEmpty()) ? 'YES' : 'NO';
}

print_r(checkIfStackPermutation([ 1, 2, 3 ], [ 2, 1, 3 ]) . PHP_EOL); // YES
print_r(checkIfStackPermutation([ 1, 2, 3 ], [ 3, 1, 2 ]) . PHP_EOL); // NO