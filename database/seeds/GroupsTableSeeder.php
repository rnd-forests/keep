<?php

use Keep\Group;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();
        for ($i = 1; $i <= 50; $i++)
        {
            $timestamp = Carbon::now()->subMonths(rand(1, 20));
            Group::create([
                'name'        => ucfirst(implode(' ', $faker->words(4))),
                'description' => $faker->paragraph(2),
                'created_at'  => $timestamp,
                'updated_at'  => $timestamp
            ]);
        }
    }

}