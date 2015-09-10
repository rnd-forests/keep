<?php

namespace Keep\Http\Composers;

use Illuminate\Contracts\View\View;
use Keep\Repositories\Group\GroupRepositoryInterface as GroupRepository;

class GroupNotificationForm
{
    protected $groups;

    public function __construct(GroupRepository $groups)
    {
        $this->groups = $groups;
    }

    public function compose(View $view)
    {
        $types = [
            'default' => 'General',
            'info'    => 'Informative',
            'success' => 'Successful',
            'warning' => 'Warning',
            'danger'  => 'Danger',
        ];
        $view->with('types', $types);
        $view->with('groups', $this->groups->getAll()->lists('name', 'id'));
    }
}
