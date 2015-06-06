<?php

use Keep\Entities\Profile;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        Profile::create([
            'user_id'          => 1,
            'location'         => 'Thai Phuong - Hung Ha - Thai Binh',
            'bio'              => $faker->paragraph(10),
            'company'          => 'Ha Noi University of Science and Technology',
            'website'          => $faker->url,
            'phone'            => $faker->phoneNumber,
            'twitter_username' => 'vinhnguyen',
            'github_username'  => 'vinhnguyentb'
        ]);

        Profile::create([
            'user_id'          => 2,
            'location'         => 'Thai Phuong - Hung Ha - Thai Binh',
            'bio'              => $faker->paragraph(10),
            'company'          => 'Deloitte',
            'website'          => $faker->url,
            'phone'            => $faker->phoneNumber,
            'twitter_username' => $faker->userName,
            'github_username'  => $faker->userName
        ]);

        for ($i = 3; $i <= 152; $i++) {
            Profile::create([
                'user_id'          => $i,
                'location'         => $faker->address,
                'bio'              => $faker->paragraph(5),
                'company'          => $faker->company,
                'website'          => $faker->url,
                'phone'            => $faker->phoneNumber,
                'twitter_username' => $faker->userName,
                'github_username'  => $faker->userName
            ]);
        }
    }
}
