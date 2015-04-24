<?php

use Keep\User;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();
        $timestamp = Carbon::now()->subYears(3);
        User::create([
            'name'       => 'Vinh Nguyen',
            'email'      => 'ngocvinh.nnv@gmail.com',
            'password'   => '123456',
            'address'    => 'Thai Phuong - Hung Ha - Thai Binh',
            'company'    => 'FPT Software',
            'website'    => 'http://www.vinhnguyen-hust.com',
            'phone'      => '01649000000',
            'about'      => 'I am a very simple person!',
            'active'     => true,
            'created_at' => $timestamp,
            'updated_at' => $timestamp
        ]);

        User::create([
            'name'       => 'Hang Dang',
            'email'      => 'hangdt.aa@gmail.com',
            'password'   => '123456',
            'address'    => 'Thai Phuong - Hung Ha - Thai Binh',
            'company'    => 'Deloitte',
            'website'    => 'http://www.hangdt-eof.com',
            'phone'      => '01697000000',
            'active'     => true,
            'created_at' => $timestamp,
            'updated_at' => $timestamp
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