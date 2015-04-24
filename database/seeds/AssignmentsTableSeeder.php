<?php

use Keep\Task;
use Carbon\Carbon;
use Keep\Assignment;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class AssignmentsTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();
        for ($i = 1; $i <= 50; $i++)
        {
            $timestamp = Carbon::now()->subDays(rand(5, 60));
            Assignment::create([
                'assignment_name' => ucfirst(implode(' ', $faker->words(6))),
                'created_at'      => $timestamp,
                'updated_at'      => $timestamp
            ]);
        }

        for ($i = 1; $i <= 50; $i++)
        {
            $timestamp = Carbon::now()->subDays(rand(5, 50));
            Task::create([
                'assignment_id'  => $i,
                'priority_id'    => rand(1, 4),
                'title'          => ucfirst(implode(" ", $faker->words(5))),
                'content'        => implode(" ", $faker->paragraphs(1)),
                'location'       => $faker->address,
                'is_assigned'    => true,
                'starting_date'  => $timestamp,
                'finishing_date' => Carbon::now()->addDays(rand(5, 50)),
                'created_at'     => $timestamp,
                'updated_at'     => $timestamp
            ]);
        }
    }

}