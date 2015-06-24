<?php
namespace Keep\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Keep\Repositories\User\UserRepositoryInterface;

class MemberNotificationForm
{
    public function compose(View $view)
    {
        $types = [
            'default' => 'General',
            'info'    => 'Informative',
            'success' => 'Successful',
            'warning' => 'Warning',
            'danger'  => 'Danger'
        ];
        $userRepo = app()->make(UserRepositoryInterface::class);
        $view->with('types', $types);
        $view->with('users', $userRepo->getAll()->lists('name', 'id'));
    }
}
