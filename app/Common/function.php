<?php

if (!function_exists('run_time')) {
    function run_time($precision = 4)
    {
        $time =
            round(
                microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'],
                $precision
            ) * 1000;

        return $time.'ms';
    }
}