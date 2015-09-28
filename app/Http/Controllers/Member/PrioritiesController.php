<?php

namespace Keep\Http\Controllers\Member;

use Keep\Http\Controllers\Controller;
use Keep\Core\Repository\Contracts\PriorityRepository;

class PrioritiesController extends Controller
{
    protected $priorities;

    public function __construct(PriorityRepository $priorities)
    {
        $this->priorities = $priorities;
        $this->middleware('auth');
        $this->middleware('valid.user');
    }

    /**
     * Show all tasks of a user that associated with a priority level.
     *
     * @param $userSlug
     * @param $priorityName
     * @return \Illuminate\View\View
     */
    public function show($userSlug, $priorityName)
    {
        $priority = $this->priorities->findByName($priorityName);
        $tasks = $this->priorities->associatedTasks($userSlug, $priorityName, 10);

        return view('users.priorities.show', compact('priority', 'tasks'));
    }
}
