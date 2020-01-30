<?php

namespace SobreFramework\Core;

/**
 * Class Server
 * @package SobreFramework\Core
 */
class Server
{
    /**
     * Get the global server variable.
     *
     * @static
     * @param string|null $key
     * @return array|mixed
     */
    public static function get(?string $key = null)
    {
        return ($key) ? $_SERVER[$key] : $_SERVER;
    }

    /**
     * Get the current URI.
     *
     * @static
     * @return string
     */
    public static function uri(): string
    {
        $uri = self::get('SCRIPT_URI') ?? self::get('REQUEST_URI');

        return str_replace(trim(env('APP_URL', config('app.url', null)), '/'), '', trim($uri, '/'));
    }

    /**
     * Check if the current HTTP request use the POST method.
     *
     * @static
     * @return bool
     */
    public static function isPostMethod(): bool
    {
        return self::get()['REQUEST_METHOD'] === 'POST';
    }

    /**
     * Check if the current HTTP request use the GET method.
     *
     * @static
     * @return bool
     */
    public static function isGetMethod(): bool
    {
        return self::get()['REQUEST_METHOD'] === 'GET';
    }
}