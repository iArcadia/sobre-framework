<?php

namespace SobreFramework\Core;

/**
 * Class Router
 * @package SobreFramework\Core
 */
class Router
{
    /**
     * Find the controller corresponding to a given URI. If no URI is given, it will take the current URI.
     *
     * @static
     * @param string|null $uri
     * @return string
     */
    public static function findController(?string $uri = null): string
    {
        if (!$uri) {
            $request_uri = Server::uri();

            $uri = ($request_uri && $request_uri !== '/') ? Server::uri() : config('router.directory-namespace');
        }

        $uri = str_replace('/', '\\', $uri);
        $uri = str_replace('-', '', $uri);
        $uri = preg_replace('/\?.*/', '', $uri);

        return config('router.index-namespace', 'App') . '\\' . trim($uri, '\\') . '\\Controller';
    }
}