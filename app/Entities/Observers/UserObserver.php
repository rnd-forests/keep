<?php

namespace Keep\Entities\Observers;

use Keep\Entities\User;
use Keep\Entities\Profile;

class UserObserver
{
    /**
     * Hook into user created event.
     *
     * @param User $user
     */
    public function created(User $user)
    {
        $user->profile()->save(new Profile);
    }

    /**
     * Hook into user deleting event.
     *
     * @param User $user
     */
    public function deleting(User $user)
    {
        $user->profile()->delete();
        $user->tasks()->get()->each(function ($task) {
            $task->delete();
        });
    }

    /**
     * Hook into user restored event.
     *
     * @param User $user
     */
    public function restored(User $user)
    {
        $user->profile()->withTrashed()->restore();
        $user->tasks()->withTrashed()->get()->each(function ($task) {
            $task->restore();
        });
    }
}
