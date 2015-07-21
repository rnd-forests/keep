<?php

namespace Keep\Http\Composers;

use Illuminate\Contracts\View\View;
use Keep\Repositories\Group\GroupRepositoryInterface as GroupRepo;

class GroupNotificationForm
{
    protected $repo;

    public function __construct(GroupRepo $repo)
    {
        $this->repo = $repo;
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
        $view->with('groups', $this->repo->getAll()->lists('name', 'id'));
    }
}
