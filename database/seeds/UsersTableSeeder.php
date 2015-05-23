<?php

use Carbon\Carbon;
use Keep\Entities\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();
        User::create([
            'name'       => 'Vinh Nguyen',
            'email'      => 'ngocvinh.nnv@gmail.com',
            'password'   => '123456789',
            'active'     => true,
            'created_at' => Carbon::now()->subYears(3),
            'updated_at' => Carbon::now()->subYears(3)
        ]);

        User::create([
            'name'       => 'Hang Dang',
            'email'      => 'hangdt.aa@gmail.com',
            'password'   => '123456789',
            'active'     => true,
            'created_at' => Carbon::now()->subYears(2),
            'updated_at' => Carbon::now()->subYears(2)
        ]);

        for ($i = 1; $i <= 150; $i++)
        {
            $timestamp = Carbon::now()->subMonths(rand(1, 20));
            User::create([
                'name'       => $faker->name,
                'email'      => $faker->email,
                'password'   => 'secret',
                'active'     => true,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]);
        }
    }

}