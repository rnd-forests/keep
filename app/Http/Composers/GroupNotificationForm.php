<?php

namespace Keep\Http\Composers;

use Illuminate\Contracts\View\View;

class GroupNotificationForm
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
        $groupRepo = app(\Keep\Repositories\UserGroup\UserGroupRepositoryInterface::class);
        $view->with('types', $types);
        $view->with('groups', $groupRepo->getAll()->lists('name', 'id'));
    }
}
