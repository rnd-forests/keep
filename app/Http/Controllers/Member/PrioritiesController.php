<?php

namespace Keep\Http\Controllers\Member;

use Keep\Http\Controllers\Controller;
use Keep\Repositories\Contracts\UserRepositoryInterface as UserRepository;
use Keep\Repositories\Contracts\PriorityRepositoryInterface as PriorityRepository;

class PrioritiesController extends Controller
{
    protected $users, $priorities;

    public function __construct(UserRepository $users, PriorityRepository $priorities)
    {
        $this->users = $users;
        $this->priorities = $priorities;
        $this->middleware('auth');
        $this->middleware('valid.user');
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
        $user = $this->users->findBySlug($userSlug);
        $priorities = $this->priorities->fetchAll();

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
        $priority = $this->priorities->findByName($priorityName);
        $tasks = $this->priorities->associatedTasks($userSlug, $priorityName, 10);

        return view('users.priorities.show', compact('priority', 'tasks'));
    }
}
