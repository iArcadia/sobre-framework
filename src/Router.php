<?php

namespace SobreFramework\Core;

/**
 * Class Router
 * @package SobreFramework\Core
 */
class Router
{
    /**
     * Get the defined routes.
     *
     * @static
     * @return array
     */
    protected static function getRoutes(): array
    {
        return require_once(root_path('app/routes/routes.php'));
    }

    /**
     * Flat the route list.
     *
     * @static
     * @param array $list
     * @param string $namespace
     * @param string $uri
     * @return array
     */
    protected static function flatRouteList(array $list = [], string $namespace = '', string $uri = ''): array
    {
        $routes = [];

        if (!$list) {
            $list = Router::getRoutes();
            $namespace = $list['namespace'];
        }

        if (isset($list['routes']) && $list['routes']) {
            foreach ($list['routes'] as $route) {
                $route['namespace'] = $namespace . '\\' . $route['namespace'];
                $route['uri'] = trim($route['uri'], '/');

                if ($uri) {
                    $route['uri'] = ($uri === '/') ? $uri . $route['uri'] : $uri . '/' . $route['uri'];
                }

                $routes[$route['uri']] = $route;

                if (isset($route['routes']) && $route['routes']) {
                    $routes = array_merge($routes, Router::flatRouteList($route, $route['namespace'], $route['uri']));
                }
            }
        }

        return $routes;
    }

    /**
     * Find the controller corresponding to a given URI. If no URI is given, it will take the current URI.
     *
     * @static
     * @param string|null $uri
     * @return string
     */
    public static function findController(?string $uri = null): string
    {
        $uri = $uri ?? Server::uri();
    }
}