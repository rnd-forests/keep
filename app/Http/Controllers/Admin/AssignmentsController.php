<?php namespace Keep\Http\Controllers\Admin;

use Keep\Http\Controllers\Controller;
use Keep\Http\Requests\GroupAssignmentRequest;
use Keep\Http\Requests\MemberAssignmentRequest;
use Keep\Commands\CreateGroupAssignmentCommand;
use Keep\Commands\CreateMemberAssignmentCommand;
use Keep\Repositories\User\UserRepositoryInterface;
use Keep\Repositories\UserGroup\UserGroupRepositoryInterface;

class AssignmentsController extends Controller {

    protected $userRepo, $groupRepo;

    /**
     * Constructor.
     *
     * @param UserRepositoryInterface      $userRepo
     * @param UserGroupRepositoryInterface $groupRepo
     */
    public function __construct(UserRepositoryInterface $userRepo, UserGroupRepositoryInterface $groupRepo)
    {
        $this->userRepo = $userRepo;
        $this->groupRepo = $groupRepo;
    }

    /**
     * Load form to assign new task to individual members.
     *
     * @return \Illuminate\View\View
     */
    public function createMemberAssignment()
    {
        $users = $this->userRepo->all()->lists('name', 'id');

        return view('admin.assignments.member_assignment', compact('users'));
    }

    /**
     * Assign tasks for members.
     *
     * @param MemberAssignmentRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeMemberAssignment(MemberAssignmentRequest $request)
    {
        $this->dispatchFrom(CreateMemberAssignmentCommand::class, $request);

        flash()->success('The assignment was assigned to selected members');

        return redirect()->back();
    }

    /**
     * Load form to assign new task to groups.
     *
     * @return \Illuminate\View\View
     */
    public function createGroupAssignment()
    {
        $groups = $this->groupRepo->all()->lists('name', 'id');

        return view('admin.assignments.group_assignment', compact('groups'));
    }

    /**
     * Assign tasks for groups.
     *
     * @param GroupAssignmentRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeGroupAssignment(GroupAssignmentRequest $request)
    {
        $this->dispatchFrom(CreateGroupAssignmentCommand::class, $request);

        flash()->success('The assignment was assigned to selected groups');

        return redirect()->back();
    }

}
