<?php

namespace database\migrations;

use src\Database;

class RoleTable
{
    public static function migrate()
    {
        $query = "
            CREATE TABLE roles (
                id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
                slug TEXT NOT NULL UNIQUE,
                name TEXT NOT NULL,
                
                created_at INTEGER NULL,
                updated_at INTEGER NULL,
                created_by INTEGER NULL,
                updated_by INTEGER NULL
            )
        ";

        Database::get()->exec($query);
    }
}
