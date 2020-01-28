<?php

namespace database\migrations;

use src\Database;

class UserTable
{
    public static function migrate()
    {
        $query = "
            CREATE TABLE users (
                id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                password TEXT NOT NULL,
                email TEXT NOT NULL,
                
                role_id INTEGER NOT NULL,
                
                created_at INTEGER NULL,
                updated_at INTEGER NULL,
                created_by INTEGER NULL,
                updated_by INTEGER NULL
            )
        ";

        Database::get()->exec($query);
    }
}
