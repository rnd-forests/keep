<?php

use Keep\Role;
use Keep\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder {

    public function run()
    {
        $adminPermissions = [
            [
                'name' => 'create-task',
                'display_name' => 'Create tasks',
                'description' => 'Create new tasks'
            ],
            [
                'name' => 'edit-user',
                'display_name' => 'Edit Users',
                'description' => 'User is allowed to edit information of accounts in the system'
            ],
            [
                'name' => 'edit-task',
                'display_name' => 'Edit tasks',
                'description' => 'User is allowed to modify tasks of other users in the system'
            ],
            [
                'name' => 'send-notification',
                'display_name' => 'Send notifications',
                'description' => 'User is allowed to send notifications to individual user or user groups in the system'
            ],
            [
                'name' => 'manage-group',
                'display_name' => 'Manage User Groups',
                'description' => 'User is allowed to create/edit user groups in the system'
            ]
        ];

        $admin = Role::where('name', '=', 'admin')->firstOrFail();

        foreach ($adminPermissions as $permission)
        {
            $admin->attachPermission(Permission::create($permission));
        }
    }

}