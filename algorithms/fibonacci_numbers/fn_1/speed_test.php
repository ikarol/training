<?php

/**
 * Testing function's perfomance
 * @param  callable $func    testable function
 * @param  Array $funcArg array of arguments
 * @return Array          array of function stats(memory usage and perfomance time)
 */
function speedTest(callable $func,...$funcArg)
{
    $args = implode(',', $funcArg);
    $startMem = memory_get_usage();
    $startTime = microtime(true);
    echo 'function result: ' . $func($args) . "\n";
    $finalMem = memory_get_usage() - $startMem;
    $finalTime = number_format((microtime(true) - $startTime), 4);
    echo 'Memory usage: ' . $finalMem . " bytes\n";
    echo 'Time: ' . $finalTime . " seconds\n";
    return [$finalMem,$finalTime];
}