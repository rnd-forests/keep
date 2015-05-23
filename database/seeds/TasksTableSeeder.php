<?php

use Carbon\Carbon;
use Keep\Entities\Task;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 25; $i++)
        {
            $timestamp = Carbon::now()->subDays(rand(0, 15))->subHours(rand(1, 20));
            Task::create([
                'user_id'        => 1,
                'priority_id'    => rand(1, 4),
                'title'          => ucfirst(implode(" ", $faker->words(5))),
                'content'        => implode(" ", $faker->paragraphs(1)),
                'location'       => $faker->address,
                'completed'      => true,
                'finished_at'    => Carbon::now(),
                'is_assigned'    => false,
                'starting_date'  => $timestamp,
                'finishing_date' => $timestamp->addDays(rand(0, 15))->addHours(rand(1, 20)),
                'created_at'     => $timestamp,
                'updated_at'     => $timestamp
            ]);
        }

        for ($i = 1; $i <= 15; $i++)
        {
            $timestamp = Carbon::now()->subDays(rand(0, 15))->subHours(rand(1, 20));
            Task::create([
                'user_id'        => 1,
                'priority_id'    => 1,
                'title'          => ucfirst(implode(" ", $faker->words(5))),
                'content'        => implode(" ", $faker->paragraphs(1)),
                'location'       => $faker->address,
                'is_assigned'    => false,
                'starting_date'  => $timestamp,
                'finishing_date' => $timestamp->addDays(rand(0, 15))->addHours(rand(1, 20)),
                'created_at'     => $timestamp,
                'updated_at'     => $timestamp
            ]);
        }

        for ($i = 1; $i <= 10; $i++)
        {
            $timestamp = Carbon::now()->subDays(rand(0, 15))->subHours(rand(1, 20));
            Task::create([
                'user_id'        => 1,
                'priority_id'    => rand(2, 4),
                'title'          => ucfirst(implode(" ", $faker->words(5))),
                'content'        => implode(" ", $faker->paragraphs(1)),
                'location'       => $faker->address,
                'is_assigned'    => false,
                'starting_date'  => $timestamp,
                'finishing_date' => $timestamp->addDays(rand(0, 15))->addHours(rand(1, 20)),
                'created_at'     => $timestamp,
                'updated_at'     => $timestamp
            ]);
        }

        for ($i = 1; $i <= 10; $i++)
        {
            $timestamp = Carbon::now()->subDays(rand(0, 15))->subHours(rand(1, 20));
            Task::create([
                'user_id'        => 1,
                'priority_id'    => rand(2, 4),
                'title'          => ucfirst(implode(" ", $faker->words(5))),
                'content'        => implode(" ", $faker->paragraphs(1)),
                'location'       => $faker->address,
                'is_assigned'    => false,
                'starting_date'  => $timestamp,
                'finishing_date' => $timestamp->addDays(rand(0, 15))->addHours(rand(1, 20)),
                'created_at'     => $timestamp,
                'updated_at'     => $timestamp
            ]);
        }

        for ($i = 1; $i <= 300; $i++)
        {
            $timestamp = Carbon::now()->subDays(rand(0, 15))->subHours(rand(1, 20));
            Task::create([
                'user_id'        => rand(1, 152),
                'priority_id'    => rand(1, 4),
                'title'          => ucfirst(implode(" ", $faker->words(5))),
                'content'        => implode(" ", $faker->paragraphs(1)),
                'location'       => $faker->address,
                'is_assigned'    => false,
                'starting_date'  => $timestamp,
                'finishing_date' => $timestamp->addDays(rand(0, 15))->addHours(rand(1, 20)),
                'created_at'     => $timestamp,
                'updated_at'     => $timestamp
            ]);
        }
    }

}