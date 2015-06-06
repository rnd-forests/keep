<?php
namespace Keep\Http\ViewComposers;

use App;
use Illuminate\Contracts\View\View;
use Keep\Repositories\UserGroup\UserGroupRepositoryInterface;

class GroupAssignmentForm
{
    public function compose(View $view)
    {
        $groupRepo = App::make(UserGroupRepositoryInterface::class);
        $view->with('groups', $groupRepo->getAll()->lists('name', 'id'));
    }
}