<?php namespace Keep\Http\Controllers;

use Keep\Repositories\User\UserRepositoryInterface;
use Keep\Repositories\Assignment\AssignmentRepositoryInterface;

class UserAssignmentController extends Controller {

    protected $assignmentRepo, $userRepo;

    /**
     * Create new user-assignment controller instance.
     *
     * @param AssignmentRepositoryInterface $assignmentRepo
     * @param UserRepositoryInterface       $userRepo
     */
    public function __construct(AssignmentRepositoryInterface $assignmentRepo, UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
        $this->assignmentRepo = $assignmentRepo;

        $this->middleware('auth');
        $this->middleware('auth.correct');
    }

    /**
     * Show all personal and group assignments of a user.
     *
     * @param $userSlug
     *
     * @return \Illuminate\View\View
     */
    public function index($userSlug)
    {
        $memberAssignments = $this->assignmentRepo->getAssignmentsAssociatedWithAUser($userSlug);

        $groupAssignments = $this->assignmentRepo->getGroupAssignmentsAssociatedWithAUser($userSlug);

        return view('users.assignments.index', compact('memberAssignments', 'groupAssignments'));
    }

    /**
     * Show user personal assignment.
     *
     * @param $userSlug
     * @param $assignmentSlug
     *
     * @return \Illuminate\View\View
     */
    public function showPersonalAssignment($userSlug, $assignmentSlug)
    {
        $assignment = $this->assignmentRepo->findPersonalAssignment($userSlug, $assignmentSlug);

        return view('users.assignments.show', compact('assignment'));
    }

    /**
     * Show user group assignment.
     *
     * @param $userSlug
     * @param $assignmentSlug
     *
     * @return \Illuminate\View\View
     */
    public function showGroupAssignment($userSlug, $assignmentSlug)
    {
        $assignment = $this->assignmentRepo->findGroupAssignment($userSlug, $assignmentSlug);

        return view('users.assignments.show', compact('assignment'));
    }

}
