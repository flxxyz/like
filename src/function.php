<?php

if (!function_exists('query_time')) {
    function query_time($precision = 4)
    {
        $time =
            round(
            microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'],
            $precision
        ) * 1000;

        return $time . 'ms';
    }
}
