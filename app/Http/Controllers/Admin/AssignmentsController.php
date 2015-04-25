<?php namespace Keep\Http\Controllers\Admin;

use Keep\Http\Controllers\Controller;
use Keep\Http\Requests\AssignmentRequest;
use Keep\Commands\ModifyAssignmentCommand;
use Keep\Commands\CreateGroupAssignmentCommand;
use Keep\Commands\CreateMemberAssignmentCommand;
use Keep\Repositories\Assignment\AssignmentRepositoryInterface;

class AssignmentsController extends Controller {

    protected $assignmentRepo;

    /**
     * Constructor.
     *
     * @param AssignmentRepositoryInterface $assignmentRepo
     */
    public function __construct(AssignmentRepositoryInterface $assignmentRepo)
    {
        $this->assignmentRepo = $assignmentRepo;
    }

    /**
     * List all available assignments.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $assignments = $this->assignmentRepo->getPaginatedAssignments(15);

        return view('admin.assignments.index', compact('assignments'));
    }

    /**
     * Show a specific assignment.
     *
     * @param $slug
     *
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $assignment = $this->assignmentRepo->findBySlug($slug);

        $task = $assignment->task->load('tags');

        return view('admin.assignments.show', compact('assignment', 'task'));
    }

    /**
     * Load the form to edit a specific assignment.
     *
     * @param $slug
     *
     * @return \Illuminate\View\View
     */
    public function edit($slug)
    {
        $assignment = $this->assignmentRepo->findBySlug($slug);

        $task = $assignment->task->load('tags');

        return view('admin.assignments.edit', compact('assignment', 'task'));
    }

    /**
     * Update a specific assignment.
     *
     * @param AssignmentRequest $request
     * @param                   $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AssignmentRequest $request, $slug)
    {
        $this->dispatchFrom(ModifyAssignmentCommand::class, $request, ['assignment_slug' => $slug]);

        flash()->info('The assignment was successfully updated');

        return redirect()->route('admin.assignments.all');
    }

    /**
     * Delete a specific task.
     *
     * @param $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($slug)
    {
        $this->assignmentRepo->delete($slug);

        flash()->info('This assignment was successfully deleted');

        return redirect()->route('admin.assignments.all');
    }

    /**
     * Load form to assign new task to individual members.
     *
     * @return \Illuminate\View\View
     */
    public function createMemberAssignment()
    {
        return view('admin.assignments.create_member_assignment');
    }

    /**
     * Assign tasks for members.
     *
     * @param AssignmentRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeMemberAssignment(AssignmentRequest $request)
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
        return view('admin.assignments.create_group_assignment');
    }

    /**
     * Assign tasks for groups.
     *
     * @param AssignmentRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeGroupAssignment(AssignmentRequest $request)
    {
        $this->dispatchFrom(CreateGroupAssignmentCommand::class, $request);

        flash()->success('The assignment was assigned to selected groups');

        return redirect()->back();
    }

}
