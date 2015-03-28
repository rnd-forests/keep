<?php

use Keep\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder {

    public function run()
    {
        $user = User::find(1);
        $user->roles()->attach(1);
        $user->roles()->attach(2);
        $user->roles()->attach(3);
    }

}