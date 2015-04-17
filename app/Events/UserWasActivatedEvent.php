<?php namespace Keep\Events;

use Keep\User;
use Illuminate\Queue\SerializesModels;

class UserWasActivatedEvent extends Event {

    use SerializesModels;

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

}
