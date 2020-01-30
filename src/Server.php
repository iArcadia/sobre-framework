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
        if ($key) {
            if (isset($_SERVER[$key])) {
                return $_SERVER[$key];
            }

            return null;
        }

        return $_SERVER;
    }

    /**
     * Get the current URI.
     *
     * @static
     * @return string
     */
    public static function uri(): string
    {
        $request_uri = self::get('SCRIPT_URI') ?? self::get('REQUEST_URI');

        $request_uri = str_replace(trim(env('APP_URL', config('app.url', null)), '/'), '', trim($request_uri, '/'));

        $uri = ($request_uri && $request_uri !== '/') ? $request_uri : config('router.root', 'home');

        return $uri;
    }

    /**
     * Check if the current HTTP request use the POST method.
     *
     * @static
     * @return bool
     */
    public static function isPostMethod(): bool
    {
        return self::get('REQUEST_METHOD') === 'POST';
    }

    /**
     * Check if the current HTTP request use the GET method.
     *
     * @static
     * @return bool
     */
    public static function isGetMethod(): bool
    {
        return self::get('REQUEST_METHOD') === 'GET';
    }
}