<?php namespace Keep\Http\Controllers;

use Keep\Repositories\Task\TaskRepositoryInterface;
use Keep\Repositories\User\UserRepositoryInterface;

class UserDashboardController extends Controller {

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

        $recentlyCompletedTasks = $this->taskRepo->fetchRecentlyCompletedTasks($user);

        return view('users.dashboard', compact('user', 'urgentTasks', 'deadlineTasks', 'recentlyCompletedTasks'));
    }

}
