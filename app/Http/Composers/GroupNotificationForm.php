<?php

namespace Keep\Http\Composers;

use Illuminate\Contracts\View\View;
use Keep\Repositories\Contracts\GroupRepositoryInterface as GroupRepository;

class GroupNotificationForm
{
    protected $groups;

    public function __construct(GroupRepository $groups)
    {
        $this->groups = $groups;
    }

    public function compose(View $view)
    {
        $view->with('types', $this->getTypes());
        $view->with('groups', $this->groups->getAll()->lists('name', 'id'));
    }

    protected function getTypes()
    {
        return [
            'default' => 'general',
            'info' => 'informative',
            'success' => 'successful',
            'warning' => 'warning',
            'danger' => 'danger',
        ];
    }
}
