<?php

/**
 * Function that should search for Shortest path(check task description) in array,
 * each path's step's value is modified by 'st' prefix(will be used for highlighting steps later)
 * @param  Array $arr  n*n array with randomized values
 * @return Array      array of coordinates
 */
function markPath(&$arr)
{
    $row = 0;
    $column = 0;
    $limit = count($arr) - 1;
    $history = '';
    // loop stops when it steps on n*n cell
    while ($row != $limit || $column != $limit) {
        // rules when moving on the bottom of the table
        // move up or move to the right
        if ($row == $limit) {
            // if upper cell's value lesser
            if ($arr[$row][$column + 1] > $arr[$row - 1][$column]) {
                // check if we stepped on upper cell before
                // if yes, then move to the right
                if (strpos($arr[$row - 1][$column], 'st') !== false) {
                    $arr[$row][$column + 1] = 'st' . $arr[$row][$column + 1];
                    $column++;
                // otherwise move up
                } else {
                    $arr[$row - 1][$column] = 'st' . $arr[$row - 1][$column];
                    $row--;
                }
            // if the value of the right cell is lesser
            } elseif ($arr[$row][$column + 1] < $arr[$row - 1][$column]) {
                // check if we stepped on the right cell before
                // if yes, then move up
                if (strpos($arr[$row][$column + 1], 'st') !== false) {
                    $arr[$row - 1][$column] = 'st' . $arr[$row - 1][$column];
                    $row--;
                // otherwise move to the right
                } else {
                    $arr[$row][$column + 1] = 'st' . $arr[$row][$column + 1];
                    $column++;
                }
            // if values are equal
            // then decide the rotation by RNG
            } else {
                // if RNG gives '1' - select upper cell
                if (rand(1, 2) == 1) {
                    // check if we stepped on the upper cell before
                    // if yes, then move to the right
                    if (strpos($arr[$row - 1][$column], 'st' !== false)){
                        $arr[$row][$column + 1] = 'st' . $arr[$row][$column + 1];
                        $column++;
                    // otherwise move up
                    } else {
                        $arr[$row - 1][$column] = 'st' . $arr[$row - 1][$column];
                        $row--;
                    }
                // if RNG gives '2' - select right cell
                } else {
                    // check if we stepped on the right cell before
                    // if yes, then move up
                    if (strpos($arr[$row][$column + 1], 'st' !== false)){
                        $arr[$row - 1][$column] = 'st' . $arr[$row - 1][$column];
                        $row--;
                    // otherwise move to the right
                    } else {
                        $arr[$row][$column + 1] = 'st' . $arr[$row][$column + 1];
                        $column++;
                    }  
                }
            }
        // rules when moving along table's right wall
        // move to the left or move down
        } elseif ($column == $limit) {
            // if left cell's value is lesser
            if ($arr[$row][$column - 1] < $arr[$row + 1][$column]) {
                // check if we stepped on the cell before
                // if yes, then move down
                if (strpos($arr[$row][$column - 1], 'st') !== false) {
                    $arr[$row + 1][$column] = 'st' . $arr[$row + 1][$column];
                    $row++;
                // otherwise move to the left
                } else {
                    $arr[$row][$column - 1] = 'st' . $arr[$row][$column - 1];
                    $column--;
                }
            // if the value of the down's cell is lesser
            } elseif ($arr[$row][$column - 1] > $arr[$row + 1][$column]){
                // check if we stepped on this cell before
                // if yes move to the left
                if (strpos($arr[$row + 1][$column], 'st') !== false) {
                    $arr[$row][$column - 1] = 'st' . $arr[$row][$column - 1];
                    $column--;
                // otherwise move down
                } else {
                    $arr[$row + 1][$column] = 'st' . $arr[$row + 1][$column];
                    $row++;
                }
            // if values are equal
            // then decide rotation by RNG
            } else {
                // if RNG gives '1' - move down
                if (rand(1,2) == 1) {
                    // check if we stepped on this cell before
                    // if yes move to the left
                    if (strpos($arr[$row + 1][$column], 'st' !== false)) {
                        $arr[$row][$column - 1] = 'st' . $arr[$row][$column - 1];
                        $column--;
                    // otherwise move down
                    } else {
                        $arr[$row + 1][$column] = 'st' . $arr[$row + 1][$column];
                        $row++;
                    }
                // if RNG gives '2' - move to the left
                } else {
                    // check if we stepped on this cell before
                    // if yes move down
                    if (strpos($arr[$row][$column - 1], 'st' !== false)){
                        $arr[$row + 1][$column] = 'st' . $arr[$row + 1][$column];
                        $row++;
                    // otherwise move to the left
                    } else {
                        $arr[$row][$column - 1] = 'st' . $arr[$row][$column - 1];
                        $column--;
                    }  
                }
            }
        // rules when simply moving inside the table
        // move to the right or move down
        } else {
            // if the value of the down's cell is lesser
            if ($arr[$row + 1][$column] < $arr[$row][$column + 1]) {
                // check if we stepped on this cell before
                // if yes, then move to the right
                if (strpos($arr[$row + 1][$column], 'st') !== false) {
                    $arr[$row][$column + 1] = 'st' . $arr[$row][$column + 1];
                    $column++;
                // otherwise move down
                } else {
                    $arr[$row + 1][$column] = 'st' . $arr[$row + 1][$column];
                    $row++;
                }
            // if value of the right cell is lesser
            } elseif ($arr[$row + 1][$column] > $arr[$row][$column + 1]) {
                // check if we stepped on this line before
                // if yes, then move down
                if (strpos($arr[$row][$column + 1], 'st') !== false) {
                    $arr[$row + 1][$column] = 'st' . $arr[$row + 1][$column];
                    $row++;
                // otherwise move to the right
                } else {
                    $arr[$row][$column + 1] = 'st' . $arr[$row][$column + 1];
                    $column++;
                }
            // if values are equal
            // decide rotation by RNG
            } else {
                // if RNG gives '1' - move down
                if (rand(1, 2) == 1) {
                    // check if we stepped on this cell before
                    // if yes, then move to the right
                    if (strpos($arr[$row + 1][$column], 'st') !== false) {
                        $arr[$row][$column + 1] = 'st' . $arr[$row][$column + 1];
                        $column++;
                    // otherwise move down
                    } else {
                        $arr[$row + 1][$column] = 'st' . $arr[$row + 1][$column];
                        $row++;
                    }
                // if RNG gives '2' - move to the right
                } else {
                    // check if we stepped on this cell before
                    // if yes, then move down
                    if (strpos($arr[$row][$column + 1], 'st') !== false) {
                        $arr[$row + 1][$column] = 'st' . $arr[$row + 1][$column];
                        $row++;
                    // otherwise move to the right
                    } else {
                        $arr[$row][$column + 1] = 'st' . $arr[$row][$column + 1];
                        $column++;
                    }
                }
            }
        }
        // save current step coordinates
        $history[] = 'row: ' . $row . '; column: ' . $column;
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
