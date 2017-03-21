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

/**
 * Function that counts the number of mondays which are on the first day of the month
 * Using strtotime function to create time stamps and for arithmetics also.
 * @return Array array of mondays
 */
// !!!!!!!!!!!!!!Doesn't work on Windows(any timestamp starts from 01.01.1970)
function mondStrToTime()
{
    date_default_timezone_set('UTC');
    $mondays = array();
    for (
        $currTimeSt = strtotime('01.01.1900');
        date('d.m.Y', $currTimeSt) != '01.01.2000';
        $currTimeSt = strtotime('+ 1 month', $currTimeSt)
    ) {
        if (date('D', $currTimeSt) == 'Mon') {
            $mondays[] = date('d.m.Y', $currTimeSt);
        }
    }
    return $mondays;
}

/**
 * Function that counts the number of mondays which are on the first day of the month.
 * Using in-built PHP classes: DateTime, DateTimeZone, DateTimeInterval
 * @return Array array of mondays
 */
function mondDateTime()
{
    $mondays = array();
    for (
        $timeSt = new DateTime('01.01.1900', new DateTimeZone('UTC'));
        $timeSt->format('d.m.Y') != '01.01.2000';
        $timeSt->add(new DateInterval('P1M'))
    ) {
        if ($timeSt->format('D') == 'Mon') {
            $mondays[] = $timeSt->format('d.m.Y');
        }
    }
    return $mondays;
}

// Finding the optimal solution
// --------------Testing mondStrToTime function --------------
$stStart = microtime(true);
echo "Testing mondStrToTime function\n";
$strToTimeMondays = mondStrToTime();
echo count($strToTimeMondays) . "\n";
foreach ($strToTimeMondays as $mon) {
    echo "$mon\n";
}
$stFinish = microtime(true) - $stStart;

// --------------Testing mondDateTime function --------------
$dtStart = microtime(true);
echo "Testing mondDateTime function\n";
$dateTimeMondays = mondDateTime();
echo count($dateTimeMondays) . "\n";
foreach ($dateTimeMondays as $mon) {
    echo "$mon\n";
}
$dtFinish = microtime(true) - $dtStart;

// Comparison
echo 'mondStrToTime time: ' . $stFinish . "\n";
echo 'mondDateTime time: ' . $dtFinish . "\n";
