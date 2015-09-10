<?php

namespace Keep\Http\Controllers\Member;

use Keep\Http\Controllers\Controller;
use Keep\Repositories\Task\TaskRepositoryInterface as TaskRepository;
use Keep\Repositories\User\UserRepositoryInterface as UserRepository;

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
        $urgent = $this->tasks->fetchUrgentTasks($user);
        $deadline = $this->tasks->fetchDeadlineTasks($user);
        $completed = $this->tasks->fetchRecentlyCompletedTasks($user);

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
        $type = 'All';
        $user = $this->users->findBySlug($userSlug);
        $tasks = $this->tasks->fetchPaginatedAllTasks($user);

        return view('users.dashboard.task_collection', compact('type', 'user', 'tasks'));
    }

    /**
     * Get all completed tasks of a user.
     *
     * @param $userSlug
     * @return \Illuminate\View\View
     */
    public function completed($userSlug)
    {
        $type = 'Completed';
        $user = $this->users->findBySlug($userSlug);
        $tasks = $this->tasks->fetchPaginatedCompletedTasks($user);

        return view('users.dashboard.task_collection', compact('type', 'user', 'tasks'));
    }

    /**
     * Get all failed tasks of a user.
     *
     * @param $userSlug
     * @return \Illuminate\View\View
     */
    public function failed($userSlug)
    {
        $type = 'Failed';
        $user = $this->users->findBySlug($userSlug);
        $tasks = $this->tasks->fetchPaginatedFailedTasks($user);

        return view('users.dashboard.task_collection', compact('type', 'user', 'tasks'));
    }

    /**
     * Get all due tasks of a user.
     *
     * @param $userSlug
     * @return \Illuminate\View\View
     */
    public function processing($userSlug)
    {
        $type = 'Processing';
        $user = $this->users->findBySlug($userSlug);
        $tasks = $this->tasks->fetchPaginatedDueTasks($user);

        return view('users.dashboard.task_collection', compact('type', 'user', 'tasks'));
    }
}
