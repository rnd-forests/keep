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
                'title' => ucfirst(implode(" ", $faker->words(6))),
                'content' => implode(" ", $faker->paragraphs(3)),
                'location' => $faker->address,
                'note' => $faker->text(),
                'completed' => true,
                'starting_date' => Carbon::now(),
                'finishing_date' => Carbon::now()->addDays(rand(5, 20))
            ]);
        }

        for ($i = 1; $i <= 300; $i++)
        {
            Task::create([
                'user_id' => rand(1, 152),
                'title' => ucfirst(implode(" ", $faker->words(6))),
                'content' => implode(" ", $faker->paragraphs(3)),
                'location' => $faker->address,
                'note' => $faker->text(),
                'starting_date' => Carbon::now(),
                'finishing_date' => Carbon::now()->addDays(rand(5, 50))
            ]);
        }
    }

}