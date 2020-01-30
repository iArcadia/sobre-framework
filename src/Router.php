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
        $uri = Server::uri();
        $nb_of_segments = substr_count($uri, '/');

        $uri = ucwords($uri, '-/');
        $uri = str_replace('/', '\\', $uri);
        $uri = str_replace('-', '', $uri);
        $uri = preg_replace('/\?.*/', '', $uri);
        $uri = ucfirst($uri);

        if ($nb_of_segments > 0) {
            $uri = explode('\\', $uri);
            array_pop($uri);
            $uri = join('\\', $uri);
        }

        return config('router.namespace', 'App\\Routes') . '\\' . trim($uri, '\\') . '\\' . basename($uri) . 'Controller';
    }

    /**
     * Find the action corresponding to a giver URI. If no URI is given, it will take the current URI.
     *
     * @static
     * @param string|null $uri
     * @return string
     */
    public static function findAction(?string $uri = null): string
    {
        $action = config('router.index', 'index');

        $uri = Server::uri();
        $nb_of_segments = substr_count($uri, '/');

        if ($nb_of_segments > 0) {
            $uri = explode('/', $uri);
            $action = array_pop($uri);
        }

        $action = strtolower(Server::get('REQUEST_METHOD')) . '_' . $action;

        return $action;
    }
}