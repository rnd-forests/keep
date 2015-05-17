<?php

use Keep\Profile;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder {
    public function run()
    {
        $faker = Faker::create();

        Profile::create([
            'user_id'          => 1,
            'location'         => 'Thai Phuong - Hung Ha - Thai Binh',
            'bio'              => $faker->paragraph(10),
            'company'          => 'FPT Software',
            'website'          => 'http://www.vinhnguyen-hust.com',
            'phone'            => '01649000000',
            'twitter_username' => 'vinhnguyen',
            'github_username'  => 'vinhnguyentb'
        ]);

        Profile::create([
            'user_id'          => 2,
            'location'         => 'Thai Phuong - Hung Ha - Thai Binh',
            'bio'              => $faker->paragraph(10),
            'company'          => 'Deloitte',
            'website'          => 'http://www.hangdt-eof.com',
            'phone'            => '01697000000',
            'twitter_username' => 'hangdangaof'
        ]);

        for ($i = 3; $i <= 152; $i++) {
            Profile::create([
                'user_id'  => $i,
                'location' => $faker->address,
                'bio'      => $faker->paragraph(4),
                'company'  => $faker->company,
                'website'  => $faker->url,
                'phone'    => $faker->phoneNumber
            ]);
        }
    }

}
