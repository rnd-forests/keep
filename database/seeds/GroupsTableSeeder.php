<?php

use Keep\Group;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 50; $i++)
        {
            Group::create([
                'name' => ucfirst(implode(' ', $faker->words(5))),
                'description' => $faker->paragraph(2)
            ]);
        }
    }

}