<?php

/**
 * Number of Mondays
 * Find the number of Mondays that are on the first day of the month
 *  starting from 01/01/1900 (DD/MM/YYYY) till 31/12/1999.
 *  Output the column with number of mondays and their dates.
 *  Some facts:
 *  January 1st 1900 - Monday
 *  There are 30 days in April, June, September and November.
 *  There are 28 days in February, but 29 days during leap year.
 *  And there are 31 days in the remaining months.
 *  Leap year - year that can be exactly divided by 4, but the first year of the century
 *  only can be called leap when exactly divided by 400.
 */

function countMondays()
{
    $year = 1900;
    $mondays = array();
    $days = 365;
    while ($year != 1999) {
        if ($year % 4 == 0) {
            $days = 366;
        } else {
            $days = 365;
        }

    }
}
