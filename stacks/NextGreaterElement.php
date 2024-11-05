<?php

// Reverse a String using Stack

function findNextGreaterElement($array, $element)
{
    $position = array_search($element, $array);

    $nextGreaterElement = $element;
    if ($position !== false) {
        for ($i=$position; $i < count($array); $i++) { 
            if ($array[$i] > $nextGreaterElement) {
                $nextGreaterElement = $array[$i];
                break;
            }
        }
    }

    $nextGreaterElement = ($nextGreaterElement == $element) ? -1 : $nextGreaterElement;

    return $nextGreaterElement;
}

print_r(findNextGreaterElement([ 4 , 5 , 2 , 25 ], 4) . PHP_EOL); // 5
print_r(findNextGreaterElement([ 4 , 5 , 2 , 25 ], 5) . PHP_EOL); // 25
print_r(findNextGreaterElement([ 4 , 5 , 2 , 25 ], 2) . PHP_EOL); // 25
print_r(findNextGreaterElement([ 4 , 5 , 2 , 25 ], 25) . PHP_EOL); // -1
print_r(findNextGreaterElement([ 13 , 7, 6 , 12 ], 13) . PHP_EOL); // -1
print_r(findNextGreaterElement([ 13 , 7, 6 , 12 ], 7) . PHP_EOL); // 12
print_r(findNextGreaterElement([ 13 , 7, 6 , 12 ], 6) . PHP_EOL); // 12
print_r(findNextGreaterElement([ 13 , 7, 6 , 12 ], 12) . PHP_EOL); // -1
