<?php

namespace SobreFramework\Core;

/**
 * Class Partial
 * @package SobreFramework\Core
 * @extends View
 */
class Partial extends View
{
    /**
     * Find a partial view file.
     *
     * @static
     * @param string $partial
     * @return string
     */
    public static function find(string $partial): string
    {
        return '_app_old/_partials/' . $partial . '.vue.php';
    }
}
