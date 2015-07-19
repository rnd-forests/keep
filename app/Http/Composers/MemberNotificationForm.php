<?php

namespace Keep\Http\Composers;

use Illuminate\Contracts\View\View;

class MemberNotificationForm
{
    public function compose(View $view)
    {
        $types = [
            'default' => 'General',
            'info'    => 'Informative',
            'success' => 'Successful',
            'warning' => 'Warning',
            'danger'  => 'Danger',
        ];
        $userRepo = app(\Keep\Repositories\User\UserRepositoryInterface::class);
        $view->with('types', $types);
        $view->with('users', $userRepo->getAll()->lists('name', 'id'));
    }
}
