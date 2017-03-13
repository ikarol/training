<?php

/*
Matrix n*n is given.
Each cell contains positive numbers.
Matrix should be filled randomly by script.

The task is to find the shortest path from cell (0,0) to cell (n,n).
Shortest path is not the number of steps,but the sum of the numbers from cells
that are on the scripts path.

The matrix and highlighted path with the sum of the numbers should be displayed
in browser.
 */

require_once 'field.php';
require_once 'path.php';
require_once 'header.html';
// $q = crField(5);
// print_r($q);
// print_R(findPath($q));
// echo drawField(findPath($q));
$field = fPath(crField(5));
$sum = calcPath($field);
echo drawField($field);
require_once 'footer.html';
