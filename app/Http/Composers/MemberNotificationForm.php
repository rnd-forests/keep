<?php

namespace Keep\Http\Composers;

use Illuminate\Contracts\View\View;
use Keep\Repositories\Contracts\UserRepositoryInterface as UserRepository;

class MemberNotificationForm
{
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function compose(View $view)
    {
        $view->with('types', $this->getTypes());
        $view->with('users', $this->users->getAll()->lists('name', 'id'));
    }

    protected function getTypes()
    {
        return [
            'default' => 'general',
            'info' => 'informative',
            'success' => 'successful',
            'warning' => 'warning',
            'danger' => 'danger',
        ];
    }
}
