<?php

if (!function_exists('snakeToCamel')) {
    /**
     * Converts a snake case string to a camel case one.
     * @param string $str
     * @return string
     */
    function snakeToCamel(string $str): string
    {
        return preg_replace_callback('/_([a-zA-Z0-9])/', function ($matches) {
            return ucfirst($matches[1]);
        }, $str);
    }
}
