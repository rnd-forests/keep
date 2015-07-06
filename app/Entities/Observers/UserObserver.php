<?php

namespace Keep\Entities\Observers;

use Keep\Entities\User;
use Keep\Entities\Profile;

class UserObserver
{
    public function created(User $user)
    {
        $user->profile()->save(new Profile);
    }

    public function deleting(User $user)
    {
        $user->profile()->delete();
        $user->tasks()->get()->each(function ($task) {
            $task->delete();
        });
    }

    public function restored(User $user)
    {
        $user->profile()->withTrashed()->restore();
        $user->tasks()->withTrashed()->get()->each(function ($task) {
            $task->restore();
        });
    }
}
