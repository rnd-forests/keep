<?php

use Keep\User;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        User::create([
            'name' => 'Vinh Nguyen',
            'email' => 'ngocvinh.nnv@gmail.com',
            'password' => '8815121993',
            'birthday' => Carbon::create(1993, 12, 15),
            'address' => 'Thai Phuong - Hung Ha - Thai Binh',
            'company' => 'FPT Software',
            'website' => 'http://www.vinhnguyenict.com',
            'phone' => '01649609698',
            'about' => 'I am a very simple person!',
            'active' => true
        ]);

        for ($i = 1; $i <= 50; $i++)
        {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => 'secret',
                'active' => true
            ]);
        }
    }

}