<?php

namespace Keep\Http\Controllers\Admin;

use Keep\Http\Controllers\Controller;
use Keep\Repositories\Task\TaskRepositoryInterface as TaskRepository;

class TasksController extends Controller
{
    protected $tasks;

    public function __construct(TaskRepository $tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * Get the active tasks.
     *
     * @return \Illuminate\View\View
     */
    public function activeTasks()
    {
        $request = app('request');
        $sortBy = $request->get('sortBy');
        $direction = $request->get('direction');
        $tasks = $this->tasks->fetchPaginatedTasks(compact('sortBy', 'direction'), 50);

        return view('admin.tasks.published_tasks', compact('tasks'));
    }

    /**
     * Display a task.
     *
     * @param $slug
     * @return \Illuminate\View\View
     */
    public function showTask($slug)
    {
        $task = $this->tasks->findBySlug($slug);

        return view('admin.tasks.task_details', compact('task'));
    }

    /**
     * Soft delete a task.
     *
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function softDelete($slug)
    {
        $this->tasks->softDelete($slug);
        flash()->info(trans('administrator.task_trashed'));

        return back();
    }

    /**
     * Get trashed tasks.
     *
     * @return \Illuminate\View\View
     */
    public function trashedTasks()
    {
        $trashedTasks = $this->tasks->fetchTrashedTasks(50);

        return view('admin.tasks.trashed_tasks', compact('trashedTasks'));
    }

    /**
     * Restore a soft deleted task.
     *
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreTask($slug)
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
    public function forceDeleteTask($slug)
    {
        $this->tasks->forceDelete($slug);
        flash()->info(trans('administrator.task_destroyed'));

        return back();
    }
}
