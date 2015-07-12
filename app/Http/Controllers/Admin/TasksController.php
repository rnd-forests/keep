<?php

namespace Keep\Http\Controllers\Admin;

use Keep\Http\Controllers\Controller;
use Keep\Repositories\Task\TaskRepositoryInterface;

class TasksController extends Controller
{
    protected $taskRepo;

    /**
     * Create new tasks controller instance.
     *
     * @param TaskRepositoryInterface $taskRepo
     */
    public function __construct(TaskRepositoryInterface $taskRepo)
    {
        $this->taskRepo = $taskRepo;
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
        $tasks = $this->taskRepo->fetchPaginatedTasks(compact('sortBy', 'direction'), 50);

        return view('admin.tasks.active_tasks', compact('tasks'));
    }

    /**
     * Display a task.
     *
     * @param $slug
     *
     * @return \Illuminate\View\View
     */
    public function showTask($slug)
    {
        $task = $this->taskRepo->findBySlug($slug);

        return view('admin.tasks.task', compact('task'));
    }

    /**
     * Soft delete a task.
     *
     * @param $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function softDelete($slug)
    {
        $this->taskRepo->softDelete($slug);
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
        $trashedTasks = $this->taskRepo->fetchTrashedTasks(50);

        return view('admin.tasks.trashed_tasks', compact('trashedTasks'));
    }

    /**
     * Restore a soft deleted task.
     *
     * @param $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreTask($slug)
    {
        $this->taskRepo->restore($slug);
        flash()->info(trans('administrator.task_restored'));

        return back();
    }

    /**
     * Permanently delete a task.
     *
     * @param $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDeleteTask($slug)
    {
        $this->taskRepo->forceDelete($slug);
        flash()->info(trans('administrator.task_destroyed'));

        return back();
    }
}
