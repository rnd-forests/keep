<?php

namespace Keep\Entities\Observers;

use Keep\Entities\User;
use Keep\Entities\Profile;

class UserObserver
{
    public function created(User $user)
    {
        $user->profile()->save(new Profile());
    }
}
