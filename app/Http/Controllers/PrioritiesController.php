<?php

namespace Keep\Http\Controllers;

use Keep\Repositories\User\UserRepositoryInterface;
use Keep\Repositories\Priority\PriorityRepositoryInterface;

class PrioritiesController extends Controller
{
    protected $priorityRepo, $userRepo;

    /**
     * Create new priorities controller instance.
     *
     * @param PriorityRepositoryInterface $priorityRepo
     * @param UserRepositoryInterface     $userRepo
     */
    public function __construct(PriorityRepositoryInterface $priorityRepo, UserRepositoryInterface $userRepo)
    {
        $this->priorityRepo = $priorityRepo;
        $this->userRepo = $userRepo;
        $this->middleware('auth');
        $this->middleware('auth.correct');
    }

    /**
     * Get all priority levels associated with a user's tasks.
     *
     * @param $userSlug
     *
     * @return \Illuminate\View\View
     */
    public function index($userSlug)
    {
        $user = $this->userRepo->findBySlug($userSlug);
        $priorities = $this->priorityRepo->fetchAll();

        return view('users.priorities.index', compact('user', 'priorities'));
    }

    /**
     * Show all tasks of a user that associated with a priority level.
     *
     * @param $userSlug
     * @param $priorityName
     *
     * @return \Illuminate\View\View
     */
    public function show($userSlug, $priorityName)
    {
        $priority = $this->priorityRepo->findByName($priorityName);
        $tasks = $this->priorityRepo->fetchTasksAssociatedWithPriority($userSlug, $priorityName, 10);

        return view('users.priorities.show', compact('priority', 'tasks'));
    }
}
