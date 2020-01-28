<?php

if (!function_exists('env')) {
    /**
     * Get data of the environment file.
     * @param string|null $key
     * @param mixed|null $default
     * @return mixed|null
     */
    function env(string $key = null, $default = null)
    {
        $key = strtoupper($key);

        $env_content = file_get_contents(root_path('.env'));
        $env_array = [];

        foreach (explode(PHP_EOL, $env_content) as $pair) {
            $data = explode('=', $pair);
            $pair_key = strtoupper($data[0]);
            $pair_value = trim($data[1]);

            if ($key === $pair_key) {
                return $pair_value;
            }

            $env_array[$pair_key] = $pair_value;
        }

        return (!$key) ? $env_array : $default;
    }
}

if (!function_exists('config')) {
    /**
     * Get data of a config file.
     * @param string $key
     * @param mixed|null $default
     * @param array $data
     * @return mixed|null
     */
    function config(string $key, $default = null, array $data = [])
    {
        $keys = explode('.', $key);

        if (!$data) {
            $config_file = array_shift($keys) . '.php';
            $data = require_once(root_path('config/' . $config_file));
        }

        if (sizeof($keys) === 0) {
            return $data ?? $default;
        } else if (sizeof($keys) === 1) {
            return $data[$keys[0]] ?? $default;
        }

        $current_key = array_shift($keys);

        return (isset($data[$current_key])) ? config(join('.', $keys), $default, $data[$current_key]) : $default;
    }
}

if (!function_exists('url')) {
    /**
     * Get the URL from the application URL.
     * @param string|null $url
     * @return string
     */
    function url(string $url = null): string
    {
        return trim(env('APP_URL'), '/') . $url;
    }
}