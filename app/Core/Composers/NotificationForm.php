<?php

namespace Keep\Core\Composers;

use Illuminate\Contracts\View\View;
use Keep\Repositories\Contracts\UserRepositoryInterface as UserRepository;
use Keep\Repositories\Contracts\GroupRepositoryInterface as GroupRepository;

class NotificationForm
{
    protected $users, $groups;

    public function __construct(UserRepository $users, GroupRepository $groups)
    {
        $this->users = $users;
        $this->groups = $groups;
    }

    public function compose(View $view)
    {
        $view->with('types', $this->getTypes());
        if (session('current.view') == 'member.noti') {
            $view->with('users', $this->listUsers());
        } elseif (session('current.view') == 'group.noti') {
            $view->with('groups', $this->listGroups());
        }
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

    protected function listUsers()
    {
        return $this->users->getAll()->lists('name', 'id');
    }

    protected function listGroups()
    {
        return $this->groups->getAll()->lists('name', 'id');
    }
}
