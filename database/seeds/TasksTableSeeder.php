<?php

use Keep\Task;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 25; $i++)
        {
            Task::create([
                'user_id' => 1,
                'priority_id' => rand(1, 4),
                'title' => ucfirst(implode(" ", $faker->words(5))),
                'content' => implode(" ", $faker->paragraphs(1)),
                'location' => $faker->address,
                'completed' => true,
                'starting_date' => Carbon::now(),
                'finishing_date' => Carbon::now()->addDays(rand(5, 20))
            ]);
        }

        for ($i = 1; $i <= 300; $i++)
        {
            Task::create([
                'user_id' => rand(1, 152),
                'priority_id' => rand(1, 4),
                'title' => ucfirst(implode(" ", $faker->words(5))),
                'content' => implode(" ", $faker->paragraphs(1)),
                'location' => $faker->address,
                'starting_date' => Carbon::now(),
                'finishing_date' => Carbon::now()->addDays(rand(5, 50))
            ]);
        }
    }

}