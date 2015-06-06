<?php
namespace Keep\Http\ViewComposers;

use App;
use Illuminate\Contracts\View\View;
use Keep\Repositories\User\UserRepositoryInterface;

class MemberAssignmentForm
{
    public function compose(View $view)
    {
        $userRepo = App::make(UserRepositoryInterface::class);
        $view->with('users', $userRepo->getAll()->lists('name', 'id'));
    }
}