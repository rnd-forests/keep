<?php
namespace Keep\Http\Composers;

use App;
use Illuminate\Contracts\View\View;
use Keep\Repositories\User\UserRepositoryInterface;

class CreateMemberAssignmentFormComposer
{
    public function compose(View $view)
    {
        $userRepo = App::make(UserRepositoryInterface::class);
        $view->with('users', $userRepo->getAll()->lists('name', 'id'));
    }
}