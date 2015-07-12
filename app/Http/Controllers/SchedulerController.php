<?php

namespace Keep\Http\Controllers;

use Keep\Repositories\Task\TaskRepositoryInterface;

class SchedulerController extends Controller
{
    protected $taskRepo;

    /**
     * Create a new scheduler controller instance.
     *
     * @param TaskRepositoryInterface $taskRepo
     */
    public function __construct(TaskRepositoryInterface $taskRepo)
    {
        $this->taskRepo = $taskRepo;
        $this->middleware('auth');
        $this->middleware('auth.correct');
    }

    /**
     * View task scheduler of a user.
     *
     * @param $userSlug
     *
     * @return \Illuminate\View\View
     */
    public function schedule($userSlug)
    {
        $tasks = $this->taskRepo->fetchAllTasksOfAUser($userSlug);
        app('JavaScript')->put(['scheduler' => $tasks]);

        return view('users.scheduler');
    }
}
