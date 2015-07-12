<?php

namespace Keep\Http\Composers;

use Illuminate\Contracts\View\View;
use Keep\Repositories\UserGroup\UserGroupRepositoryInterface;

class GroupAssignmentForm
{
    public function compose(View $view)
    {
        $groupRepo = app(UserGroupRepositoryInterface::class);
        $view->with('groups', $groupRepo->getAll()->lists('name', 'id'));
    }
}
