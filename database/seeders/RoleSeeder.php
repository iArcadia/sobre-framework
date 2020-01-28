<?php

namespace database\seeders;

use app\role\Role;
use app\role\RoleManager;

class RoleSeeder
{
    public static function seed()
    {
        $role = new Role();

        $role->setName('Administrateur')->setSlug('admin');

        RoleManager::insert($role);

        $role = new Role();

        $role->setName('Joueur')->setSlug('player');

        RoleManager::insert($role);
    }
}
