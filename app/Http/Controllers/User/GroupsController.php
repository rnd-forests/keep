<?php

namespace Keep\Http\Controllers\User;

use Keep\Http\Controllers\Controller;
use Keep\Core\Repository\Contracts\UserRepository;
use Keep\Core\Repository\Contracts\GroupRepository;

class GroupsController extends Controller
{
    protected $users, $groups;

    public function __construct(UserRepository $users, GroupRepository $groups)
    {
        $this->users = $users;
        $this->groups = $groups;
        $this->middleware('auth');
        $this->middleware('valid.user');
    }

    /**
     * Get all groups associated with a user.
     *
     * @param $userSlug
     * @return \Illuminate\View\View
     */
    public function index($userSlug)
    {
        $groups = $this->groups->joinedGroups($userSlug);

        return view('users.groups.index', compact('groups'));
    }

    /**
     * View a specific group that a user belongs to.
     *
     * @param $userSlug
     * @param $groupSlug
     * @return \Illuminate\View\View
     */
    public function show($userSlug, $groupSlug)
    {
        $user = $this->users->findBySlug($userSlug);
        $group = $this->groups->findBySlug($groupSlug);
        $members = $this->groups->fetchMembers($groupSlug);

        return view('users.groups.show', compact('user', 'group', 'members'));
    }
}
