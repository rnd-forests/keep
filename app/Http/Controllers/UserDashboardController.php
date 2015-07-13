<?php

namespace Keep\Http\Controllers;

use Keep\Repositories\Task\TaskRepositoryInterface;
use Keep\Repositories\User\UserRepositoryInterface;

class UserDashboardController extends Controller
{
    protected $userRepo, $taskRepo;

    /**
     * Create new user dashboard controller instance.
     *
     * @param UserRepositoryInterface $userRepo
     * @param TaskRepositoryInterface $taskRepo
     */
    public function __construct(UserRepositoryInterface $userRepo, TaskRepositoryInterface $taskRepo)
    {
        $this->userRepo = $userRepo;
        $this->taskRepo = $taskRepo;
        $this->middleware('auth');
        $this->middleware('auth.correct');
    }

    /**
     * User dashboard.
     *
     * @param $userSlug
     *
     * @return \Illuminate\View\View
     */
    public function dashboard($userSlug)
    {
        $user = $this->userRepo->findBySlug($userSlug);
        $urgentTasks = $this->taskRepo->fetchUserUrgentTasks($user);
        $deadlineTasks = $this->taskRepo->fetchUserDeadlineTasks($user);
        $recentlyCompletedTasks = $this->taskRepo->fetchUserRecentlyCompletedTasks($user);

        return view('users.dashboard.dashboard', compact(
            'user', 'urgentTasks', 'deadlineTasks', 'recentlyCompletedTasks'
        ));
    }

    /**
     * Get all tasks of a user.
     *
     * @param $userSlug
     *
     * @return \Illuminate\View\View
     */
    public function allTasks($userSlug)
    {
        $user = $this->userRepo->findBySlug($userSlug);
        $tasks = $this->taskRepo->fetchUserPaginatedTasksCollection($user);

        return view('users.dashboard.all_tasks', compact('user', 'tasks'));
    }

    /**
     * Get all completed tasks of a user.
     *
     * @param $userSlug
     *
     * @return \Illuminate\View\View
     */
    public function completedTasks($userSlug)
    {
        $user = $this->userRepo->findBySlug($userSlug);
        $tasks = $this->taskRepo->fetchUserPaginatedCompletedTasks($user);

        return view('users.dashboard.completed_tasks', compact('user', 'tasks'));
    }

    /**
     * Get all failed tasks of a user.
     *
     * @param $userSlug
     *
     * @return \Illuminate\View\View
     */
    public function failedTasks($userSlug)
    {
        $user = $this->userRepo->findBySlug($userSlug);
        $tasks = $this->taskRepo->fetchUserPaginatedFailedTasks($user);

        return view('users.dashboard.failed_tasks', compact('user', 'tasks'));
    }

    /**
     * Get all due tasks of a user.
     *
     * @param $userSlug
     *
     * @return \Illuminate\View\View
     */
    public function dueTasks($userSlug)
    {
        $user = $this->userRepo->findBySlug($userSlug);
        $tasks = $this->taskRepo->fetchUserPaginatedDueTasks($user);

        return view('users.dashboard.due_tasks', compact('user', 'tasks'));
    }
}
