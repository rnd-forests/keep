<?php

use Keep\Group;
use Illuminate\Database\Seeder;

class GroupUserTableSeeder extends Seeder {

    public function run()
    {
        for ($i = 1; $i <= 50; $i++)
        {
            $group = Group::find($i);

            for ($j = 1; $j <= rand(5, 25); $j++)
            {
                $group->users()->attach(rand(1, 150));
            }
        }
    }

}
