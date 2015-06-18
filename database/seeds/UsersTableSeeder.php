<?php

use Keep\Entities\Tag;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $tagIds = Tag::lists('id')->all();


        $owner = factory(Keep\Entities\User::class)->create([
            'name'  => 'Keep Owner',
            'email' => 'anonymous@keep.com'
        ]);
        $owner->roles()->attach(1);
        $owner->profile()->save(factory(Keep\Entities\Profile::class)->make());


        $admin = factory(Keep\Entities\User::class, 1)->create([
            'name'  => 'Vinh Nguyen',
            'email' => 'ngocvinh.nnv@gmail.com'
        ]);
        $admin->roles()->attach(2);
        $admin->profile()->save(factory(Keep\Entities\Profile::class)->make());
        factory(Keep\Entities\Notification::class, 15)
            ->create()
            ->each(function ($noti) use ($admin) {
                $admin->notifications()->attach($noti->id);
            });
        $admin->tasks()->saveMany(factory(Keep\Entities\Task::class, 35)
            ->create()
            ->each(function ($task) use ($tagIds) {
                shuffle($tagIds);
                $task->tags()->sync(
                    array_slice($tagIds, rand(1, count($tagIds)))
                );
            })
        );


        factory(Keep\Entities\User::class, 100)->create()->each(function ($user) use ($tagIds) {
            $user->profile()->save(factory(Keep\Entities\Profile::class)->make());
            factory(Keep\Entities\Notification::class, 3)
                ->create()
                ->each(function ($noti) use ($user) {
                    $user->notifications()->attach($noti->id);
                });
            $user->tasks()->saveMany(factory(Keep\Entities\Task::class, 3)
                ->create()
                ->each(function ($task) use ($tagIds) {
                    shuffle($tagIds);
                    $task->tags()->sync(
                        array_slice($tagIds, rand(1, count($tagIds)))
                    );
                })
            );
        });
    }
}
