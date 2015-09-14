<?php

namespace Keep\Http\Controllers\Member;

use Keep\Http\Controllers\Controller;
use Keep\Repositories\Contracts\UserRepositoryInterface as UserRepository;
use Keep\Repositories\Contracts\GroupRepositoryInterface as GroupRepository;

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
        $groups = $this->groups->fetchGroupsOfUser($userSlug);

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
        $members = $this->groups->fetchMembersOfGroup($groupSlug);

        return view('users.groups.show', compact('user', 'group', 'members'));
    }
}
