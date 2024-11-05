<?php

function sortArray($array)
{
    for ($i=0; $i < count($array); $i++) { 
        for ($j=0; $j < count($array) - 1; $j++) { 
            if ($array[$j] > $array[$j+1]) {
                $tmp = $array[$j+1];
                $array[$j+1] = $array[$j];
                $array[$j] = $tmp;
            }
        }
    }

    return $array;
}

print_r(sortArray(['2','4','8','5','1','7','6','9','10','3']));