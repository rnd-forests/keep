<?php

use Keep\Entities\User;
use Keep\Entities\Group;
use Illuminate\Database\Seeder;

class AssignmentsTableSeeder extends Seeder
{
    public function run()
    {
        $userIds = User::lists('id')->all();
        $groupIds = Group::lists('id')->all();

        factory(Keep\Entities\Assignment::class, 20)
            ->create()
            ->each(function ($assignment) use ($userIds) {
                $assignment->task()->save(
                    factory(Keep\Entities\Task::class)->make([
                        'is_assigned' => true
                    ])
                );
                shuffle($userIds);
                $assignment->users()->sync(
                    array_slice(
                        $userIds,
                        rand(count($userIds) / 2, count($userIds))
                    )
                );
            });

        factory(Keep\Entities\Assignment::class, 20)
            ->create()
            ->each(function ($assignment) use ($groupIds) {
                $assignment->task()->save(
                    factory(Keep\Entities\Task::class)->make([
                        'is_assigned' => true
                    ])
                );
                shuffle($groupIds);
                $assignment->groups()->sync(
                    array_slice(
                        $groupIds,
                        rand(count($groupIds) / 2, count($groupIds))
                    )
                );
            });
    }
}
