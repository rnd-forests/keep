<?php

namespace Keep\Http\Composers;

use Illuminate\Contracts\View\View;
use Keep\Repositories\User\UserRepositoryInterface as UserRepo;

class MemberNotificationForm
{
    protected $repo;

    public function __construct(UserRepo $repo)
    {
        $this->repo = $repo;
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
        $view->with('users', $this->repo->getAll()->lists('name', 'id'));
    }
}
