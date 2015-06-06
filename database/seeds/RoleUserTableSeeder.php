<?php

use Keep\Entities\Role;
use Keep\Entities\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    public function run()
    {
        $admin = Role::where('name', 'admin')->firstOrFail();
        $owner = Role::where('name', 'owner')->firstOrFail();

        $fly = User::find(1);
        $moon = User::find(2);

        $fly->attachRole($admin);
        $fly->attachRole($owner);

        $moon->attachRole($admin);
    }
}