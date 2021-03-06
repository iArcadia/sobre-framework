<?php

if (!function_exists('to_path')) {
    /**
     * Convert a string to a path string.
     * @param string $str
     * @return string
     */
    function to_path(string $str): string
    {
        $str = trim($str, '/' . DIRECTORY_SEPARATOR);
        $str = str_replace('/', DIRECTORY_SEPARATOR, $str);

        return $str;
    }
}

if (!function_exists('path_go_back')) {
    /**
     * Return the path after going back of $nb levels from $from.
     * @param int $nb
     * @param string $from
     * @return string
     */
    function path_go_back(int $nb = 1, string $from = __DIR__): string
    {
        if ($nb <= 0) {
            return to_path($from);
        }

        return to_path(dirname($from, $nb));
    }
}

if (!function_exists('path_go_back_until')) {
    /**
     * Return the path after going back to $until from $from.
     * @param string $until
     * @param string $from
     * @return string
     */
    function path_go_back_until(string $until, string $from = __DIR__): string
    {
        $until = to_path($until);

        while ($until !== basename($from)) {
            $from = path_go_back(1, $from);
        }

        return $from;
    }
}

if (!function_exists('path_goto')) {
    /**
     * Return the path after going to $to from $from.
     * @param string|array $to
     * @param string $from
     * @return string
     */
    function path_goto($to, string $from = __DIR__): string
    {
        if (is_string($to)) {
            $to = [$to];
        }

        foreach ($to as &$item) {
            $item = to_path($item);
        }

        return join(DIRECTORY_SEPARATOR, array_merge([to_path($from)], $to));
    }
}

if (!function_exists('sobre_path')) {
    /**
     * Get the Sobre Framework library path.
     * @param string $to
     * @return string
     */
    function sobre_path(string $to = ''): string
    {
        return path_goto($to, path_go_back_until('sobre-framework'));
    }
}

if (!function_exists('root_path')) {
    /**
     * Get the project root path.
     * @param string $to
     * @return string
     */
    function root_path(string $to = ''): string
    {
        return path_goto($to, path_go_back(1, path_go_back_until('vendor')));
    }
}

if (!function_exists('recursive_path')) {
    /**
     * Return an array of a directory and its children.
     * @param string $from
     * @param array $excluded_files
     * @param Closure|null $cb
     * @return array
     */
    function recursive_path(string $from = __DIR__, array $excluded_files = [], ?\Closure $cb = null): array
    {
        $paths = [];

        $filter = function ($file, $key, $i) use ($excluded_files) {
            if ($i->hasChildren() && !in_array($file->getFilename(), $excluded_files)) {
                return true;
            }

            return $file->isFile();
        };

        $i = new RecursiveDirectoryIterator($from, RecursiveDirectoryIterator::SKIP_DOTS);
        $ii = new RecursiveIteratorIterator(
            new RecursiveCallbackFilterIterator($i, $filter)
        );

        foreach ($ii as $path => $item) {
            $paths[] = $path;

            if ($cb) {
                $cb($path, $item);
            }
        }

        return $paths;
    }
}

if (!function_exists('read_sobreignore')) {
    function read_sobreignore(string $from = __DIR__): array
    {
        $files = [];
        $ignore_file = path_goto('.sobreignore', $from);

        if (file_exists($ignore_file)) {
            $files = explode(PHP_EOL, file_get_contents($ignore_file));
        }

        return $files;
    }
}