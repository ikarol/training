<?php

/*
Find first Fibonacci number that has at least 100 symbols.
Find optimal solution.
For operations with big numbers use BCMath module.
 */

require_once 'speed_test.php';

echo 'Symbols number is 100' . "\n";

/**
 * Function that gets first Fibonacci number based on given amount of number's symbols
 * each number adds to array
 * @param  integer $range  amount of number's symbols
 * @return integer         first number with $range symbols of number
 */
function fibonacci_arr()
{
    $result = [0,1];
    $i = 2;
    while(strlen($result[count($result)-1]) != 100) {
        $result[] = bcadd($result[$i-1], $result[$i-2]);
        $i++;
    }
    return $result[count($result)-1];
}

/**
 * Function that gets first Fibonacci number based on given amount of number's symbols
 * each Fibonacci number is assigned to variable
 * @param  integer $range  amount of number's symbols
 * @return integer         first number with $range symbols of number
 */
function fibonacci_loop()
{
    $x = 0;    
    $y = 1; 
    $z = 0;
    while(strlen($z) != 100) { 
        $z = bcadd($x, $y);
        $x = $y;
        $y = $z;
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
function fibonacci_gr()
{
    $x = 1;    
    $y = 1; 
    $z = 0;
    $i = 2;
    define('gr', 1.618034);
    while(strlen($z) != 100) { 
        $z = (int)(bcsub(pow(gr, $i),pow(bcsub(1, gr,6), $i),6) / sqrt(5));
        $x = $y;
        $y = $z;
        $i++;
    }
    return $z;
}

echo "--------------Array solution------------------\n";
$as_st = microtime(true);
echo 'Function result: ' . fibonacci_arr() . "\n";
$as_et = microtime(true) - $as_st;
echo 'Time: ' . $as_et . "\n";
echo "--------------Loop solution------------------\n";
$ls_st = microtime(true);
echo 'Function result: ' . fibonacci_loop() . "\n";
$ls_et = microtime(true) - $ls_st;
echo 'Time: ' . $ls_et . "\n";
// works slowly with big numbers
// echo "--------------Golden Ratio solution-------------\n";
// $grs_st = microtime(true);
// echo 'Function result: ' . fibonacci_gr() . "\n";
// $grs_et = microtime(true) - $grs_st;
// echo 'Time: ' . $grs_et . "\n";

