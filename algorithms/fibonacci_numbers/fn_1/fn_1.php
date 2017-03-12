<?php

/*
Find first Fibonacci number that has at least 100 symbols.
Find optimal solution.
For operations with big numbers use BCMath module.
 */

require_once 'speed_test.php';

$symbols = rand(100,1000);
echo 'Symbols number is ' . $symbols . "\n";
$stats = [];

/**
 * Function that gets first Fibonacci number based on given amount of number's symbols
 * each number adds to array
 * @param  integer $range  amount of number's symbols
 * @return integer         first number with $range symbols of number
 */
function fibonacci_arr($range = 100)
{
    $result = [0,1];
    $i = 2;
    $count = 0;
    while($count != $range) {
        $result[] = bcadd($result[$i-1], $result[$i-2]);
        $i++;
        $last_el = count($result)-1;
        $count = strlen($result[$last_el]);
    }
    return $result[count($result)-1];
}

/**
 * Function that gets first Fibonacci number based on given amount of number's symbols
 * each Fibonacci number is assigned to variable
 * @param  integer $range  amount of number's symbols
 * @return integer         first number with $range symbols of number
 */
function fibonacci_loop($range = 100)
{
    $x = 0;    
    $y = 1; 
    $z = 0;
    $count = 0;
    while($count != $range) { 
        $z = bcadd($x, $y);
        $x = $y;
        $y = $z;
        $count = strlen($z);
    }
    return $z;
}

/**
 * Function that gets first Fibonacci number based on given amount of number's symbols
 * each Fibonacci number is calculated using Golden Ratio(~1.618034) assigned to variable
 * @param  integer $range amount of number's symbols
 * @return integer         first number with $range symbols of number
 */
// Works slowly with big numbers
function fibonacci_gr($range = 100)
{
    $x = 1;    
    $y = 1; 
    $z = 0;
    $count = 0;
    $i = 2;
    define('gr', 1.618034);
    while($count != $range) { 
        $z = (int)(bcsub(pow(gr, $i),pow(bcsub(1, gr,6), $i),6) / sqrt(5));
        $x = $y;
        $y = $z;
        $i++;
        $count = strlen($z);
    }
    return $z;
}

echo "--------------Array solution------------------\n";
$stats[] = speedTest('fibonacci_arr', $symbols);

echo "--------------Loop solution------------------\n";
$stats[] = speedTest('fibonacci_loop', $symbols);

// works slowly with big numbers
// echo "--------------Golden Ratio solution-------------\n";
// $sta
// ts[] = speedTest('fibonacci_gr', $symbols);
