<?php namespace Keep\Http\Controllers\Admin;

use Keep\Http\Controllers\Controller;
use Keep\Repositories\Task\TaskRepositoryInterface;

class TasksController extends Controller {

    protected $taskRepository;

    /**
     * Constructor.
     *
     * @param TaskRepositoryInterface $taskRepository
     */
    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Get the active tasks.
     *
     * @return \Illuminate\View\View
     */
    public function activeTasks()
    {
        $tasksCount = $this->taskRepository->count();

        $tasks = $this->taskRepository->getPaginatedTasks(50);

        return view('admin.tasks.active_tasks', compact('tasksCount', 'tasks'));
    }

    /**
     * View a specific task.
     *
     * @param $slug
     *
     * @return \Illuminate\View\View
     */
    public function showTask($slug)
    {
        $task = $this->taskRepository->findBySlug($slug);

        return view('admin.tasks.task_view', compact('task'));
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
        $this->taskRepository->delete($slug);

        flash()->info('This task was successfully sent to the trash.');

        return redirect()->back();
    }

    /**
     * Get trashed tasks.
     *
     * @return \Illuminate\View\View
     */
    public function trashedTasks()
    {
        $trashedTasks = $this->taskRepository->getTrashedTasks(50);

        return view('admin.tasks.trashed_tasks', compact('trashedTasks'));
    }

    /**
     * Restore a soft delete task.
     *
     * @param $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restoreTask($slug)
    {
        $this->taskRepository->restore($slug);

        flash()->info('This task has been restored');

        return redirect()->back();
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
        $this->taskRepository->forceDelete($slug);

        flash()->info('This task was permanently deleted.');

        return redirect()->back();
    }

}