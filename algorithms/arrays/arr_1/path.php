<?php

/**
 * Function that should search for Shortest path(check task description) in array,
 * each path's step's value is modified by 'st' prefix(will be used for highlighting steps later)
 * @param  Array $arr  n*n array with randomized values
 * @return Array      array of coordinates
 */
function markPath(&$arr)
{
    $x = 0;
    $y = 0;
    $d = count($arr);
    $history = '';
    // loop stops when it steps on n*n cell
    while ($x != $d - 1 || $y != $d - 1) {
        // rules when moving on the bottom of the table
        // move up or move to the right
        if ($x == $d - 1) {
            // if upper cell's value lesser
            if ($arr[$x][$y + 1] > $arr[$x - 1][$y]) {
                // check if we stepped on upper cell before
                // if yes, then move to the right
                if (strpos($arr[$x - 1][$y], 'st') !== false) {
                    $arr[$x][$y + 1] = 'st' . $arr[$x][$y + 1];
                    $y++;
                // otherwise move up
                } else {
                    $arr[$x - 1][$y] = 'st' . $arr[$x - 1][$y];
                    $x--;
                }
            // if the value of the right cell is lesser
            } elseif ($arr[$x][$y + 1] < $arr[$x - 1][$y]) {
                // check if we stepped on the right cell before
                // if yes, then move up
                if (strpos($arr[$x][$y + 1], 'st') !== false) {
                    $arr[$x - 1][$y] = 'st' . $arr[$x - 1][$y];
                    $x--;
                // otherwise move to the right
                } else {
                    $arr[$x][$y + 1] = 'st' . $arr[$x][$y + 1];
                    $y++;
                }
            // if values are equal
            // then decide the rotation by RNG
            } else {
                // if RNG gives '1' - select upper cell
                if (rand(1,2) == 1) {
                    // check if we stepped on the upper cell before
                    // if yes, then move to the right
                    if (strpos($arr[$x - 1][$y], 'st' !== false)){
                        $arr[$x][$y + 1] = 'st' . $arr[$x][$y + 1];
                        $y++;
                    // otherwise move up
                    } else {
                        $arr[$x - 1][$y] = 'st' . $arr[$x - 1][$y];
                        $x--;
                    }
                // if RNG gives '2' - select right cell
                } else {
                    // check if we stepped on the right cell before
                    // if yes, then move up
                    if (strpos($arr[$x][$y + 1], 'st' !== false)){
                        $arr[$x - 1][$y] = 'st' . $arr[$x - 1][$y];
                        $x--;
                    // otherwise move to the right
                    } else {
                        $arr[$x][$y + 1] = 'st' . $arr[$x][$y + 1];
                        $y++;
                    }  
                }
            }
        // rules when moving along table's right wall
        // move to the left or move down
        } elseif ($y == $d - 1) {
            // if left cell's value is lesser
            if ($arr[$x][$y - 1] < $arr[$x + 1][$y]) {
                // check if we stepped on the cell before
                // if yes, then move down
                if (strpos($arr[$x][$y - 1], 'st') !== false) {
                    $arr[$x + 1][$y] = 'st' . $arr[$x + 1][$y];
                    $x++;
                // otherwise move to the left
                } else {
                    $arr[$x][$y - 1] = 'st' . $arr[$x][$y - 1];
                    $y--;
                }
            // if the value of the down's cell is lesser
            } elseif ($arr[$x][$y - 1] > $arr[$x + 1][$y]){
                // check if we stepped on this cell before
                // if yes move to the left
                if (strpos($arr[$x + 1][$y], 'st') !== false) {
                    $arr[$x][$y - 1] = 'st' . $arr[$x][$y - 1];
                    $y--;
                // otherwise move down
                } else {
                    $arr[$x + 1][$y] = 'st' . $arr[$x + 1][$y];
                    $x++;
                }
            // if values are equal
            // then decide rotation by RNG
            } else {
                // if RNG gives '1' - move down
                if (rand(1,2) == 1) {
                    // check if we stepped on this cell before
                    // if yes move to the left
                    if (strpos($arr[$x + 1][$y], 'st' !== false)) {
                        $arr[$x][$y - 1] = 'st' . $arr[$x][$y - 1];
                        $y--;
                    // otherwise move down
                    } else {
                        $arr[$x + 1][$y] = 'st' . $arr[$x + 1][$y];
                        $x++;
                    }
                // if RNG gives '2' - move to the left
                } else {
                    // check if we stepped on this cell before
                    // if yes move down
                    if (strpos($arr[$x][$y - 1], 'st' !== false)){
                        $arr[$x + 1][$y] = 'st' . $arr[$x + 1][$y];
                        $x++;
                    // otherwise move to the left
                    } else {
                        $arr[$x][$y - 1] = 'st' . $arr[$x][$y - 1];
                        $y--;
                    }  
                }
            }
        // rules when simply moving inside the table
        // move to the right or move down
        } else {
            // if the value of the down's cell is lesser
            if ($arr[$x + 1][$y] < $arr[$x][$y + 1]) {
                // check if we stepped on this cell before
                // if yes, then move to the right
                if (strpos($arr[$x + 1][$y], 'st') !== false) {
                    $arr[$x][$y + 1] = 'st' . $arr[$x][$y + 1];
                    $y++;
                // otherwise move down
                } else {
                    $arr[$x + 1][$y] = 'st' . $arr[$x + 1][$y];
                    $x++;
                }
            // if value of the right cell is lesser
            } elseif ($arr[$x + 1][$y] > $arr[$x][$y + 1]) {
                // check if we stepped on this line before
                // if yes, then move down
                if (strpos($arr[$x][$y + 1], 'st') !== false) {
                    $arr[$x + 1][$y] = 'st' . $arr[$x + 1][$y];
                    $x++;
                // otherwise move to the right
                } else {
                    $arr[$x][$y + 1] = 'st' . $arr[$x][$y + 1];
                    $y++;
                }
            // if values are equal
            // decide rotation by RNG
            // TODO: add check for 'stepped before' condition for both cases
            } else {
                // if RNG gives '1' - move down
                if (rand(1, 2) == 1) {
                    $arr[$x + 1][$y] = 'st' . $arr[$x + 1][$y];
                    $x++;
                // otherwise move to the right
                } else {
                    $arr[$x][$y + 1] = 'st' . $arr[$x][$y + 1];
                    $y++; 
                }
            }
        }
        // save current step coordinates
        $history[] = 'x: ' . $x . ';y: ' . $y;
    }
    return $history;
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
