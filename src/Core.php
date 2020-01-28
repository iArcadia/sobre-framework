<?php

namespace SobreFramework\Core;

/**
 * Class Core
 * @package SobreFramework\Core
 */
class Core
{
    protected static
        /** @var Database The database instance of the application. */
        $database;

    /**
     * Start the core of the application for HTTP client.
     *
     * @static
     * @return void
     */
    public static function start(): void
    {
        Session::start();
        self::database();
    }

    /**
     * Start the core of the application for command lines.
     *
     * @return void
     * @todo CHECK
     * @static
     */
    public static function command(): void
    {
        self::database();
    }

    /**
     * Get the database instance of the application.
     *
     * @static
     * @return Database
     */
    public static function database(): Database
    {
        if (!self::$database) {
            self::$database = new Database;
        }

        return self::$database;
    }
}
