<?php
namespace Keep\Http\Composers;

use App;
use Illuminate\Contracts\View\View;
use Keep\Repositories\User\UserRepositoryInterface;
use Keep\Repositories\UserGroup\UserGroupRepositoryInterface;

class EditAssignmentFormComposer
{
    public function compose(View $view)
    {
        $userRepo = App::make(UserRepositoryInterface::class);
        $view->with('users', $userRepo->getAll()->lists('name', 'id'));

        $groupRepo = App::make(UserGroupRepositoryInterface::class);
        $view->with('groups', $groupRepo->getAll()->lists('name', 'id'));
    }
}