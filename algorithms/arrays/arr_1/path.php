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
    // while (($x !== $d - 1 && $y !== $d) || ($y !== $d - 1 && $x !== $d)) {
    while ($x != $d - 1 || $y != $d - 1) {
        // while ($y != $d - 1) {
            if ($x == 0 && $y == 0){
                if ($arr[$x + 1][$y] < $arr[$x][$y + 1]){
                    $arr[$x + 1][$y] = 'st' . $arr[$x + 1][$y];
                    $x++;
                    // continue;
                    echo '<p>Start x step</p>';
                } elseif ($arr[$x + 1][$y] > $arr[$x][$y + 1]) {
                    $arr[$x][$y + 1] = 'st' . $arr[$x][$y + 1];
                    $y++;
                    echo '<p>Start y step</p>';
                } else {
                    if (rand(1,2) == 1) {
                        $arr[$x + 1][$y] = 'st' . $arr[$x + 1][$y];
                        $x++;
                        // continue;
                        echo '<p>Randomized start x step</p>';
                    } else {
                        $arr[$x][$y + 1] = 'st' . $arr[$x][$y + 1];
                        $y++;
                        echo '<p>Randomized start y step</p>';  
                    }
                }
            } 
            // elseif ($y == $d - 1 && $x == 0) {
            //     $arr[$x + 1][$y] = 'st' . $arr[$x + 1][$y];
            //     $x++;
            //     echo '<p>Y border</p>';
            //     // continue;
            // } 
            elseif ($x == $d - 1) {
                if ($arr[$x][$y + 1] > $arr[$x - 1][$y]){
                    if (strpos($arr[$x - 1][$y], 'st') !== false) {
                        $arr[$x][$y + 1] = 'st' . $arr[$x][$y + 1];
                        $y++;
                    } else {
                        $arr[$x - 1][$y] = 'st' . $arr[$x - 1][$y];
                        $x--;
                    }
                    
                } elseif ($arr[$x][$y + 1] < $arr[$x - 1][$y]){
                    if (strpos($arr[$x][$y + 1], 'st') !== false) {
                        $arr[$x - 1][$y] = 'st' . $arr[$x - 1][$y];
                        $x--;
                    } else {
                        $arr[$x][$y + 1] = 'st' . $arr[$x][$y + 1];
                        $y++;
                    }
                    echo '<p>X border</p>';
                }
                // continue;
            } elseif ($y == $d - 1) {
                if ($arr[$x][$y - 1] < $arr[$x + 1][$y]) {
                    if (strpos($arr[$x][$y - 1], 'st') !== false) {
                        $arr[$x + 1][$y] = 'st' . $arr[$x + 1][$y];
                        $x++;
                    } else {
                        $arr[$x][$y - 1] = 'st' . $arr[$x][$y - 1];
                        $y--;
                    }
                } elseif ($arr[$x][$y - 1] > $arr[$x + 1][$y]){
                    if (strpos($arr[$x + 1][$y], 'st') !== false) {
                        $arr[$x][$y - 1] = 'st' . $arr[$x][$y - 1];
                        $y--;
                    } else {
                        $arr[$x + 1][$y] = 'st' . $arr[$x + 1][$y];
                        $x++;
                    }
                    echo '<p>Y border</p>';
                }
                // continue;
            } else {
                if ($arr[$x + 1][$y] < $arr[$x][$y + 1]){
                    if (strpos($arr[$x + 1][$y], 'st') !== false){
                        $arr[$x][$y + 1] = 'st' . $arr[$x][$y + 1];
                        $y++;
                    } else {
                        $arr[$x + 1][$y] = 'st' . $arr[$x + 1][$y];
                        $x++;
                    }
                        // continue;
                        echo '<p>Simple x step</p>';
                } elseif ($arr[$x + 1][$y] > $arr[$x][$y + 1]) {
                    if (strpos($arr[$x][$y + 1], 'st') !== false){
                        $arr[$x + 1][$y] = 'st' . $arr[$x + 1][$y];
                        $x++;
                    } else {
                        $arr[$x][$y + 1] = 'st' . $arr[$x][$y + 1];
                        $y++;
                    }
                    echo '<p>Simple y step</p>';
                } else {
                    if (rand(1,2) == 1) {
                        $arr[$x + 1][$y] = 'st' . $arr[$x + 1][$y];
                        $x++;
                        // continue;
                        echo '<p>Randomized simple x step</p>';
                    } else {
                        $arr[$x][$y + 1] = 'st' . $arr[$x][$y + 1];
                        $y++;
                        echo '<p>Randomized simple y step</p>';  
                    }
                }
            }
            // echo '<p>x: ' . $x . ';y: ' . $y . '</p>';
        // }
        echo '<p>x: ' . $x . ';y: ' . $y . '</p>';
        echo '<p> right </p>';
    }
    echo '<p>Final x: ' . $x . ';y: ' . $y . '</p>';
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
