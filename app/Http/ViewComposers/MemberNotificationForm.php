<?php
namespace Keep\Http\ViewComposers;

use App;
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
        $userRepo = App::make(UserRepositoryInterface::class);
        $view->with('types', $types);
        $view->with('users', $userRepo->getAll()->lists('name', 'id'));
    }
}