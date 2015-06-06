<?php
namespace Keep\Http\Controllers\Admin;

use Keep\Http\Controllers\Controller;
use Keep\Http\Requests\AssignmentRequest;
use Keep\Commands\ModifyAssignmentCommand;
use Keep\Commands\CreateGroupAssignmentCommand;
use Keep\Commands\CreateMemberAssignmentCommand;
use Keep\Repositories\Assignment\AssignmentRepositoryInterface;

class AssignmentsController extends Controller
{
    protected $assignmentRepo;

    /**
     * Create new assignments controller instance.
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
     * Display an assignment.
     *
     * @param $slug
     *
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $assignment = $this->assignmentRepo->findBySlug($slug);

        return view('admin.assignments.show', compact('assignment'));
    }

    /**
     * Get form to edit an assignment.
     *
     * @param $slug
     *
     * @return \Illuminate\View\View
     */
    public function edit($slug)
    {
        $assignment = $this->assignmentRepo->findBySlug($slug);
        $task = $assignment->task->load('tags', 'priority');

        return view('admin.assignments.edit', compact('assignment', 'task'));
    }

    /**
     * Update an assignment.
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
     * Delete an assignment.
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
     * Get form to create new assignment for members.
     *
     * @return \Illuminate\View\View
     */
    public function createMemberAssignment()
    {
        return view('admin.assignments.create_member_assignment');
    }

    /**
     * Persist assignment for members to database.
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
     * Get form to create new assignment for groups.
     *
     * @return \Illuminate\View\View
     */
    public function createGroupAssignment()
    {
        return view('admin.assignments.create_group_assignment');
    }

    /**
     * Persist assignment for groups to database.
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

    /**
     * Get all trashed assignments.
     *
     * @return \Illuminate\View\View
     */
    public function trashedAssignments()
    {
        $trashedAssignments = $this->assignmentRepo->getTrashedAssignments(10);

        return view('admin.assignments.trashed_assignments', compact('trashedAssignments'));
    }

    /**
     * Restore a trashed assignment.
     *
     * @param $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($slug)
    {
        $this->assignmentRepo->restore($slug);
        flash()->success('This assignment was successfully restored');

        return redirect()->back();
    }

    /**
     * Force delete a trashed assignment.
     *
     * @param $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDeleteAssignment($slug)
    {
        $this->assignmentRepo->forceDelete($slug);
        flash()->info('This assignment was permanently deleted.');

        return redirect()->back();
    }
}
