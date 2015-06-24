<?php

namespace Keep\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Keep\Repositories\User\UserRepositoryInterface;

class MemberAssignmentForm
{
    public function compose(View $view)
    {
        $userRepo = app()->make(UserRepositoryInterface::class);
        $view->with('users', $userRepo->getAll()->lists('name', 'id'));
    }
}
