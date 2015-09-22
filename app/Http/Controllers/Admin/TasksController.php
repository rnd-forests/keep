<?php

namespace Keep\Http\Controllers\Admin;

use Keep\Http\Controllers\Controller;
use Keep\Repositories\Contracts\TaskRepository;

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
    public function index()
    {
        $request = app('request');
        $sortBy = $request->get('sortBy');
        $direction = $request->get('direction');
        $tasks = $this->tasks->paginate(50, compact('sortBy', 'direction'));

        return view('admin.tasks.published_tasks', compact('tasks'));
    }

    /**
     * Display a task.
     *
     * @param $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
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
    public function destroy($slug)
    {
        $this->tasks->softDelete($slug);
        flash()->info(trans('administrator.task_trashed'));

        return back();
    }
}
