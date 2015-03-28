<?php

use Keep\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder {

    public function run()
    {
        $roles = [
            'manage_tasks' => 'manage tasks',
            'manage_users' => 'manage user accounts',
        ];

        foreach ($roles as $role => $description)
        {
            Role::create([
                'name'        => $role,
                'description' => $description,
            ]);
        }
    }

}