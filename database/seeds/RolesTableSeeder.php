<?php

use Keep\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder {

    public function run()
    {
        $roles = [
            [
                'name'         => 'admin',
                'display_name' => 'Keep Administrator',
                'description'  => 'User is allowed to manage and edit other users/tasks'
            ],
            [
                'name'         => 'editor',
                'display_name' => 'Keep Editor',
                'description'  => 'User is allowed to have complete control over content'
            ],
            [
                'name'         => 'owner',
                'display_name' => 'Keep Owner',
                'description'  => 'User is the owner of Keep'
            ]
        ];

        foreach ($roles as $role)
        {
            Role::create($role);
        }
    }

}
