<?php

use Keep\Profile;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProfilesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        Profile::create([
            'user_id' => 1,
            'location' => 'Thai Phuong - Hung Ha - Thai Binh',
            'bio' => 'I am a very simple person!',
            'company'    => 'FPT Software',
            'website'    => 'http://www.vinhnguyen-hust.com',
            'phone'      => '01649000000',
            'twitter_username' => 'vinhnguyenhust',
            'github_username' => 'vinhnguyentb'
        ]);

        Profile::create([
            'user_id' => 2,
            'location' => 'Thai Phuong - Hung Ha - Thai Binh',
            'company'    => 'Deloitte',
            'website'    => 'http://www.hangdt-eof.com',
            'phone'      => '01697000000',
            'twitter_username' => 'hangdangaof'
        ]);

        for ($i = 3; $i <= 152; $i++)
        {
            Profile::create([
                'user_id' => $i,
                'location' => $faker->address,
                'bio' => $faker->paragraph(),
                'company' => $faker->company,
                'website' => $faker->url,
                'phone' => $faker->phoneNumber
            ]);
        }
    }

}
