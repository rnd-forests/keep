<?php
namespace Keep\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Keep\Repositories\UserGroup\UserGroupRepositoryInterface;

class GroupNotificationForm
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
        $groupRepo = app()->make(UserGroupRepositoryInterface::class);
        $view->with('types', $types);
        $view->with('groups', $groupRepo->getAll()->lists('name', 'id'));
    }
}
