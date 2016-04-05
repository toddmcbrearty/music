<?php

if(!function_exists('isenv')) {
    function isenv($env) {
        return app()->environment() === $env;
    }
}

if(!function_exists('enable_query_log')) {
    function enable_query_log()
    {
        \DB::connection()->enableQueryLog();
    }
}

if(!function_exists('print_query_log')) {
    function print_query_log($die = true)
    {
        $qlog = \DB::getQueryLog();;

        if($die)
            dd($qlog);

        return $qlog;
    }
}