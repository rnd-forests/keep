<?php

namespace Keep\Http\Controllers\Admin;

use Keep\Http\Controllers\Controller;
use Keep\Repositories\Contracts\TaskRepository;

class TasksTrashedController extends Controller
{
    protected $tasks;

    public function __construct(TaskRepository $tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * Get trashed tasks.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $trashedTasks = $this->tasks->trashed(50);

        return view('admin.tasks.trashed_tasks', compact('trashedTasks'));
    }

    /**
     * Restore a soft deleted task.
     *
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($slug)
    {
        $this->tasks->restore($slug);
        flash()->info(trans('administrator.task_restored'));

        return back();
    }

    /**
     * Permanently delete a task.
     *
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($slug)
    {
        $this->tasks->forceDelete($slug);
        flash()->info(trans('administrator.task_destroyed'));

        return back();
    }
}