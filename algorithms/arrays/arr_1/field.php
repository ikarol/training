<?php

/**
 * Function that creates n*n array and randomizes each of it's value
 * @param  integer $n array's dimension
 * @return Array    ready to use array
 */
function crField($n)
{
    $field = array();
    for ($i = 0; $i < $n; $i++) {
        $cols = array();
        for ($j = 0; $j < $n; $j++) {
            $cols[] = rand(1,100);
        }
        $field[$i] = $cols;
    }
    $field[0][0] = 'Start';
    $field[$n - 1][$n - 1] = 'Finish';
    return $field;
}
/**
 * Function that draws table with highlighted Shortest path(check task description)
 * @param  Array $arr array with defined shortest path
 * @return string      HTML table with highlighted path
 */
function drawField($arr)
{
    $table = '<table border="1" cellpadding="10">';
    foreach ($arr as $value) {
        foreach ($value as $k => $val) {
            if ($k % count($value) != 0) {
                if (strpos($val, 'st') !== false) {
                    $table .= '<td style="background: green">' . substr($val, 2) . '</td>';
                    continue;
                }
                $table .= '<td>' . $val . '</td>';  
            } else {
                if (strpos($val, 'st') !== false) {
                    $table .= '<tr><td style="background: green">' . substr($val, 2) . '</td>';
                    continue;
                }
                $table .= '<tr><td>' . $val . '</td>';
            }
        }
    }
    $table .= '</tr></table>';
    return $table;
}