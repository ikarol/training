<?php

// for testing
// not final solution
function findPath($arr)
{
    foreach ($arr as $key => &$val) {
        foreach ($val as $k => &$v) {
            if (rand(0, 1) === 1) {
                $v = 'st' . $v;
            }
        }
    }
    return $arr;
}

/**
 * Function that should search Shortest path(check task description) in array
 * each path's step's value is modified by 'st' prefix(will be used for highlighting steps later)
 * @param  Array $arr  n*n array with randomized values
 * @return Array      modified array with defined shortest path
 */
function fPath($arr)
{
    $x = 0;
    $y = 0;
    $d = count($arr);

    while ($x != $d - 1) {
        $y = 0;
        while ($y != $d - 1) {
            if ($x == 0 && $y == 0){
                if ($arr[$x + 1][$y] < $arr[$x][$y + 1]){
                    $arr[$x + 1][$y] = 'st' . $arr[$x + 1][$y];
                    break;
                }
                $arr[$x][$y + 1] = 'st' . $arr[$x][$y + 1];
            } 
            // elseif ($x == $d){
            //         $arr[$x][$y + 1] = 'st' . $arr[$x][$y + 1];
            //         break;
            // } elseif ($y == $d) {
            //     $arr[$x + 1][$y] = 'st' . $arr[$x + 1][$y];
            //         break;
            // }
            // $arr[$x][$y + 1] = 'st' . $arr[$x][$y + 1];
            $y++;
        }
        $x++;
    }
    return $arr;
}

/**
 * Function that calculates sum of elements of Shortest path(check task description)
 * @param  Array $arr array with defined shortest path
 * @return integer      sum of elements
 */
function calcPath($arr)
{
    $sum = 0;
    foreach ($arr as $key => $value) {
        foreach ($value as $k => $v) {
            if (strpos($v, 'st') !== false) {
                $sum += substr($v, 2);
            }
        }
    }
    return $sum;
}
