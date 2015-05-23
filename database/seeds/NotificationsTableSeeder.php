<?php

use Carbon\Carbon;
use Keep\Entities\User;
use Faker\Factory as Faker;
use Keep\Entities\Notification;
use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder {
    public function run()
    {
        $faker = Faker::create();
        $users = User::all();

        foreach ($users as $user)
        {
            for ($i = 1; $i <= 5; $i++) {
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
}
