<?php

namespace database\seeders;

use app\role\RoleManager;
use app\user\User;
use app\user\UserManager;

class UserSeeder
{
    public static function seed()
    {
        $user = new User;

        $user
            ->setName('iArcadia')
            ->setPassword('z5t0gv00')
            ->setEmail('bibollet.kevin@gmail.com')
            ->setRoleId(RoleManager::findBy('slug', 'admin')->getId());

        UserManager::insert($user);

        $user
            ->setName('CTRFRANCE')
            ->setPassword('ecnarfrtc')
            ->setEmail('ctrfrance.com')
            ->setRoleId(RoleManager::findBy('slug', 'admin')->getId());

        UserManager::insert($user);
    }
}
