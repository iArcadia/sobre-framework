<?php

namespace database;

use database\migrations\RoleTable;
use database\migrations\UserTable;
use database\seeders\RoleSeeder;
use database\seeders\UserSeeder;
use SobreFramework\Core\Database;

/**
 * Class Migrator
 * @package database
 */
class Migrator
{
    /**
     * Migrate all given migrations.
     *
     * @static
     * @return void
     */
    public static function migrate(): void
    {
        $list = [
            RoleTable::class,
            UserTable::class
        ];

        foreach ($list as $item) {
            $item::migrate();
        }

        echo 'All migrations have been executed.';
    }

    /**
     * Seed the database thanks to all given seeders.
     *
     * @static
     * @return void
     */
    public static function seed(): void
    {
        $list = [
            RoleSeeder::class,
            UserSeeder::class
        ];

        foreach ($list as $item) {
            $item::seed();
        }

        echo 'All seeders have been executed.';
    }

    /**
     * Empty the database.
     *
     * @static
     * @return void
     */
    public static function drop(): void
    {
        Database::reset();

        echo 'All database tables have been dropped.';
    }
}
