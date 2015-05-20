<?php

use Keep\Entities\Role;
use Keep\Entities\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder {

    public function run()
    {
        $user = User::find(1);
        $admin = Role::where('name', '=', 'admin')->firstOrFail();
        $user->attachRole($admin);
    }

}