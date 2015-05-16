<?php

use Keep\User;
use Carbon\Carbon;
use Keep\Notification;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder {
    public function run()
    {
        $faker = Faker::create();
        $user = User::find(1);

        for ($i = 1; $i <= 10; $i++) {
            $user->notifications()->save(Notification::create([
                'sent_from' => 'admin',
                'type'      => 'info',
                'subject'   => $faker->sentence(),
                'body'      => $faker->paragraph(),
                'sent_at'   => Carbon::now()
            ]));
        }

        for ($i = 1; $i <= 5; $i++) {
            $user->notifications()->save(Notification::create([
                'sent_from' => 'admin',
                'type'      => 'warning',
                'subject'   => $faker->sentence(),
                'body'      => $faker->paragraph(),
                'sent_at'   => Carbon::now()->subDays(10)
            ]));
        }

        for ($i = 1; $i <= 5; $i++) {
            $user->notifications()->save(Notification::create([
                'sent_from' => 'admin',
                'type'      => 'danger',
                'subject'   => $faker->sentence(),
                'body'      => $faker->paragraph(),
                'sent_at'   => Carbon::now()->subDays(15)
            ]));
        }
    }
}
