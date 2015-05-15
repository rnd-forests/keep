<?php

use Carbon\Carbon;
use Keep\Notification;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 20; $i++)
        {
            Notification::create([
                'user_id' => 1,
                'subject' => $faker->sentence(),
                'body' => $faker->paragraph(),
                'sent_at' => Carbon::now()
            ]);
        }
    }
}
