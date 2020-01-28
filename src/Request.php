<?php

namespace SobreFramework\Core;

/**
 * Class Request
 * @package SobreFramework\Core
 */
class Request
{
    /**
     * Get one or all GET HTTP request parameter(s).
     *
     * @static
     * @param string|null $key
     * @return mixed|null
     */
    public static function get(?string $key = null)
    {
        $data = self::process($_GET);

        return ($key) ? ($data[$key] ?? null) : $data;
    }

    /**
     * Get one or all POST HTTP request parameter(s).
     *
     * @static
     * @param string|null $key
     * @return mixed|null
     */
    public static function post(?string $key = null)
    {
        $data = self::process(array_merge($_POST, $_FILES));

        return ($key) ? ($data[$key] ?? null) : $data;
    }

    /**
     * Process all the HTTP request parameters.
     *
     * @static
     * @param array $data
     * @return array
     */
    protected static function process(array $data): array
    {
        $data = self::clean($data);
        $data = self::type($data);

        return $data;
    }

    /**
     * Remove all HTML special characters from the parameters.
     *
     * @static
     * @param array $data
     * @return array
     */
    protected static function clean(array $data): array
    {
        foreach ($data as &$item) {
            if (is_array($item)) {
                foreach ($item as &$subitem) {
                    if (is_string($subitem)) {
                        $subitem = htmlspecialchars($subitem);
                    }
                }
            } else {
                $item = htmlspecialchars($item);
            }
        }

        return $data;
    }

    /**
     * Transform all parameters into the best matching variable type.
     *
     * @static
     * @param array $data
     * @return array
     */
    protected static function type(array $data): array
    {
        foreach ($data as &$item) {
            if (is_numeric($item)) {
                if (strpos($item, '.') !== false) {
                    $item = (float)$item;
                } else {
                    $item = (int)$item;
                }
            }
        }

        return $data;
    }
}
