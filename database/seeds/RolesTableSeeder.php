<?php

use Keep\Entities\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'name'         => 'owner',
                'display_name' => 'Keep Owner',
                'description'  => 'User is the owner of Keep'
            ],
            [
                'name'         => 'admin',
                'display_name' => 'Keep Administrator',
                'description'  => 'User is allowed to manage and edit other users/tasks/assignments/notifications'
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
