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
 * Using built-in PHP classes: DateTime, DateTimeZone, DateTimeInterval
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

/**
 * Function that counts the number of mondays which are on the first day of the month.
 * Using JDC and Gregorian calendar
 * @return Array array of mondays
 */
function mondGr()
{
    $mondays = array();
    for (
        $timeSt = GregorianToJD(1, 1, 1900);
        JDToGregorian($timeSt) != '1/1/2000';
    ) {
        if (JDDayOfWeek($timeSt, 0) === 1) {
            $mondays[] = JDToGregorian($timeSt);
        }
        switch (explode('/', JDToGregorian($timeSt))[0]) {
            case '2':
                $year = explode('/', JDToGregorian($timeSt))[2];
                if (substr($year, 2) == '00') {
                    if ($year % 400 === 0) {
                        $timeSt += 29;
                        break;
                    }
                    $timeSt += 28;
                    break;
                } elseif ($year % 4 === 0) {
                    $timeSt += 29;
                    break;
                }
                $timeSt += 28;
                break;
            case '1':
            case '3':
            case '5':
            case '7':
            case '8':
            case '10':
            case '12':
                $timeSt += 31;
                break;
            case '4':
            case '6':
            case '9':
            case '11':
                $timeSt += 30;
                break;
        }
    }
    return $mondays;
}


/**
 * Function that counts the number of mondays which are on the first day of the month.
 * Using JDC and Gregorian calendar
 * @return Array array of mondays
 * simpler version of upper function
 */
function mondGr2()
{
    $mondays = array();
    for (
        $year = 1900;
        $year != 2000;
        $year++
    ) {
        for ($month = 1; $month <= 12; $month++) {
            $timeSt = GregorianToJD($month, 1, $year);
            if (JDDayOfWeek($timeSt, 0) === 1) {
                $mondays[] = addZero(JDToGregorian($timeSt));
            }
        }
    }
    return $mondays;
}
function addZero($gregStr)
{
    $dateParams = explode('/', $gregStr);
    list($month, $day, $year) = $dateParams;
    if (strlen($month) != 2) {
        $month = '0' . $month;
    }
    return "$month.0{$day}.$year";
}

// Finding the optimal solution
// --------------Testing mondStrToTime function --------------
$stStart = microtime(true);
echo 'Testing mondStrToTime function', PHP_EOL;
$strToTimeMondays = mondStrToTime();
echo count($strToTimeMondays), PHP_EOL;
echo implode(PHP_EOL, $strToTimeMondays), PHP_EOL;
$stFinish = microtime(true) - $stStart;

// --------------Testing mondDateTime function --------------
$dtStart = microtime(true);
echo 'Testing mondDateTime function', PHP_EOL;
$dateTimeMondays = mondDateTime();
echo count($dateTimeMondays), PHP_EOL;
echo implode(PHP_EOL, $dateTimeMondays), PHP_EOL;
$dtFinish = microtime(true) - $dtStart;

// --------------Testing mondGr function --------------
$grStart = microtime(true);
echo 'Testing mondGr function', PHP_EOL;
$grMondays = mondGr();
echo count($grMondays), PHP_EOL;
echo implode(PHP_EOL, $grMondays), PHP_EOL;
$grFinish = microtime(true) - $grStart;

// --------------Testing mondGr2 function --------------
$gr2Start = microtime(true);
echo 'Testing mondGr2 function', PHP_EOL;
$gr2Mondays = mondGr2();
echo count($gr2Mondays), PHP_EOL;
echo implode(PHP_EOL, $gr2Mondays), PHP_EOL;
$gr2Finish = microtime(true) - $gr2Start;
// Comparison
echo 'mondStrToTime time: ' . $stFinish, PHP_EOL;
echo 'mondDateTime time: ' . $dtFinish, PHP_EOL;
echo 'mondGr time: ' . $grFinish, PHP_EOL;
echo 'mondGr2 time: ' . $gr2Finish, PHP_EOL;
