<?php

namespace Keep\Http\Composers;

use Illuminate\Contracts\View\View;
use Keep\Repositories\User\UserRepositoryInterface as UserRepository;

class MemberNotificationForm
{
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function compose(View $view)
    {
        $types = [
            'default' => 'General',
            'info'    => 'Informative',
            'success' => 'Successful',
            'warning' => 'Warning',
            'danger'  => 'Danger',
        ];
        $view->with('types', $types);
        $view->with('users', $this->users->getAll()->lists('name', 'id'));
    }
}
