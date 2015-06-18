<?php

use Keep\Entities\User;
use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    public function run()
    {
        $userIds = User::lists('id')->all();

        factory(Keep\Entities\Group::class, 25)
            ->create()
            ->each(function ($group) use ($userIds) {
                shuffle($userIds);
                $group->users()->sync(
                    array_slice(
                        $userIds,
                        rand(count($userIds) / 2, count($userIds))
                    )
                );

                factory(Keep\Entities\Notification::class, 10)
                    ->create()
                    ->each(function ($noti) use ($group) {
                        $group->notifications()->attach($noti->id);
                    });
            });
    }
}
