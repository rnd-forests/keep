<?php namespace Keep\Http\Controllers;

use Keep\Repositories\Priority\PriorityRepositoryInterface;

class PrioritiesController extends Controller {

    protected $priorityRepo;

    /**
     * Create new priorities controller instance.
     *
     * @param PriorityRepositoryInterface $priorityRepo
     */
    public function __construct(PriorityRepositoryInterface $priorityRepo)
    {
        $this->priorityRepo = $priorityRepo;

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
        $priorities = $this->priorityRepo->getAssociatedPriorities($userSlug);

        return view('users.priorities.index', compact('priorities'));
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

        $tasks = $this->priorityRepo->getTasksOfUserAssociatedWithAPriority($userSlug, $priorityName, 10);

        return view('users.priorities.show', compact('priority', 'tasks'));
    }

}
