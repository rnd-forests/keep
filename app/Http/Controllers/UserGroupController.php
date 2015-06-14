<?php
namespace Keep\Http\Controllers;

use Keep\Repositories\User\UserRepositoryInterface;
use Keep\Repositories\UserGroup\UserGroupRepositoryInterface;

class UserGroupController extends Controller
{
    protected $userRepo, $groupRepo;

    /**
     * Create new user-group controller instance.
     *
     * @param UserRepositoryInterface      $userRepo
     * @param UserGroupRepositoryInterface $groupRepo
     */
    public function __construct(UserRepositoryInterface $userRepo, UserGroupRepositoryInterface $groupRepo)
    {
        $this->userRepo = $userRepo;
        $this->groupRepo = $groupRepo;
        $this->middleware('auth');
        $this->middleware('auth.correct');
    }

    /**
     * Get all groups associated with a user.
     *
     * @param $userSlug
     *
     * @return \Illuminate\View\View
     */
    public function index($userSlug)
    {
        $groups = $this->groupRepo->fetchGroupsOfUser($userSlug);

        return view('users.groups.index', compact('groups'));
    }

    /**
     * View a specific group that a user belongs to.
     *
     * @param $userSlug
     * @param $groupSlug
     *
     * @return \Illuminate\View\View
     */
    public function show($userSlug, $groupSlug)
    {
        $user = $this->userRepo->findBySlug($userSlug);
        $group = $this->groupRepo->findBySlug($groupSlug);
        $members = $this->groupRepo->fetchMembersOfGroup($groupSlug);
        $assignments = $this->groupRepo->fetchAssignmentsOfGroup($groupSlug);

        return view('users.groups.show', compact('user', 'group', 'members', 'assignments'));
    }
}
