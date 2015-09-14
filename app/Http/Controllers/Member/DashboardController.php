<?php

namespace Keep\Http\Controllers\Member;

use Keep\Http\Controllers\Controller;
use Keep\Repositories\Contracts\TaskRepositoryInterface as TaskRepository;
use Keep\Repositories\Contracts\UserRepositoryInterface as UserRepository;

class DashboardController extends Controller
{
    protected $users, $tasks;

    public function __construct(UserRepository $users, TaskRepository $tasks)
    {
        $this->users = $users;
        $this->tasks = $tasks;
        $this->middleware('auth');
        $this->middleware('valid.user');
    }

    /**
     * User dashboard.
     *
     * @param $userSlug
     * @return \Illuminate\View\View
     */
    public function dashboard($userSlug)
    {
        $user = $this->users->findBySlug($userSlug);
        $urgent = $this->tasks->urgentTasks($user);
        $deadline = $this->tasks->deadlineTasks($user);
        $completed = $this->tasks->recentlyCompletedTasks($user);

        return view('users.dashboard.dashboard', compact('user', 'urgent', 'deadline', 'completed'));
    }

    /**
     * Get all tasks of a user.
     *
     * @param $userSlug
     * @return \Illuminate\View\View
     */
    public function all($userSlug)
    {
        return $this->fetchTasks('All', 'users.dashboard.task_collection',
            $userSlug, 'allTasks');
    }

    /**
     * Get all completed tasks of a user.
     *
     * @param $userSlug
     * @return \Illuminate\View\View
     */
    public function completed($userSlug)
    {
        return $this->fetchTasks('Completed', 'users.dashboard.task_collection',
            $userSlug, 'completedTasks');
    }

    /**
     * Get all failed tasks of a user.
     *
     * @param $userSlug
     * @return \Illuminate\View\View
     */
    public function failed($userSlug)
    {
        return $this->fetchTasks('Failed', 'users.dashboard.task_collection',
            $userSlug, 'failedTasks');
    }

    /**
     * Get all processing tasks of a user.
     *
     * @param $userSlug
     * @return \Illuminate\View\View
     */
    public function processing($userSlug)
    {
        return $this->fetchTasks('Processing', 'users.dashboard.task_collection',
            $userSlug, 'processingTasks');
    }

    /**
     * A helper method to fetch tasks associated with a type.
     *         
     * @param $type      
     * @param $view      
     * @param $slug      
     * @param $repoMethod
     * @return \Illuminate\View\View
     */
    protected function fetchTasks($type, $view, $slug, $repoMethod)
    {
        $user = $this->users->findBySlug($slug);
        $tasks = $this->tasks->$repoMethod($user);

        return view($view, compact('type', 'user', 'tasks'));
    }
}
