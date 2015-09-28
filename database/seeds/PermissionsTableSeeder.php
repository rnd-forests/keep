<?php

use Keep\Entities\Role;
use Keep\Entities\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'name'         => 'create-task',
                'description'  => 'Create new tasks'
            ],
            [
                'name'         => 'edit-user',
                'description'  => 'User is allowed to edit information of accounts in the system'
            ],
            [
                'name'         => 'edit-task',
                'description'  => 'User is allowed to modify tasks of other users in the system'
            ],
            [
                'name'         => 'send-notification',
                'description'  => 'User is allowed to send notifications to individual user or user groups in the system'
            ],
            [
                'name'         => 'manage-group',
                'description'  => 'User is allowed to create/edit user groups in the system'
            ]
        ];

        $owner = Role::where('name', 'owner')->firstOrFail();
        $admin = Role::where('name', 'admin')->firstOrFail();

        foreach ($permissions as $permission) {
            $dbPermission = Permission::create($permission);
            $owner->attachPermission($dbPermission);
            $admin->attachPermission($dbPermission);
        }
    }
}
