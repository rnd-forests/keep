<?php
namespace Keep\Listeners\ModelObservers;

use Keep\Entities\User;
use Keep\Entities\Profile;

class UserObserver
{
    public function created(User $user)
    {
        $user->profile()->save(new Profile());
    }
}
