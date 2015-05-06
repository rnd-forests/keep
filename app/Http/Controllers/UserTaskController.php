<?php namespace Keep\Http\Controllers;

use Keep\Http\Requests\TaskRequest;
use Keep\Events\TaskWasCreatedEvent;
use Keep\Repositories\Task\TaskRepositoryInterface;
use Keep\Repositories\User\UserRepositoryInterface;

class UserTaskController extends Controller {

    protected $userRepo, $taskRepo;

    /**
     * Create a new user-task controller instance.
     *
     * @param UserRepositoryInterface $userRepo
     * @param TaskRepositoryInterface $taskRepo
     */
    public function __construct(UserRepositoryInterface $userRepo,
                                TaskRepositoryInterface $taskRepo)
    {
        $this->userRepo = $userRepo;
        $this->taskRepo = $taskRepo;

        $this->middleware('auth');
        $this->middleware('auth.correct');
    }
    
    /**
     * Get form to create new task.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $user = $this->userRepo->getAuthUser();

        return view('users.tasks.create', compact('user'));
    }

    /**
     * Persist a new task.
     *
     * @param TaskRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TaskRequest $request)
    {
        $author = $this->userRepo->getAuthUser();

        $task = $author->tasks()->save($this->createTask($request));

        event(new TaskWasCreatedEvent($author, $task));

        flash()->success('Your tasks has been successfully created');

        return redirect()->route('users.dashboard', $author);
    }

    /**
     * Create new task.
     *
     * @param TaskRequest $request
     *
     * @return mixed
     */
    private function createTask(TaskRequest $request)
    {
        $task = $this->taskRepo->create($request->all());

        $this->setRelations($task, $request);

        return $task;
    }

    /**
     * Set proper relations on task updating/creating.
     *
     * @param             $task
     * @param TaskRequest $request
     */
    private function setRelations($task, TaskRequest $request)
    {
        $this->taskRepo->syncTags($task, $request->input('tag_list', []));

        $this->taskRepo->associatePriority($task, $request->input('priority_level'));
    }

    /**
     * Show a task of a user.
     *
     * @param $userSlug
     * @param $taskSlug
     *
     * @return \Illuminate\View\View
     */
    public function show($userSlug, $taskSlug)
    {
        $user = $this->userRepo->findBySlug($userSlug);

        $task = $this->taskRepo->findCorrectTaskBySlug($userSlug, $taskSlug);

        return view('users.tasks.show', compact('task', 'user'));
    }

    /**
     * Get form to update a task.
     *
     * @param $userSlug
     * @param $taskSlug
     *
     * @return \Illuminate\View\View
     */
    public function edit($userSlug, $taskSlug)
    {
        $user = $this->userRepo->findBySlug($userSlug);

        $task = $this->taskRepo->findCorrectTaskBySlug($userSlug, $taskSlug);

        return view('users.tasks.edit', compact('user', 'task'));
    }

    /**
     * Update a task.
     *
     * @param TaskRequest $request
     * @param             $userSlug
     * @param             $taskSlug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TaskRequest $request, $userSlug, $taskSlug)
    {
        $task = $this->taskRepo->update($userSlug, $taskSlug, $request->all());

        $this->setRelations($task, $request);

        flash()->info('Your task was successfully updated');

        return redirect()->route('users.dashboard', $this->userRepo->getAuthUser());
    }

    /**
     * Delete a task.
     *
     * @param $userSlug
     * @param $taskSlug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($userSlug, $taskSlug)
    {
        $this->taskRepo->deleteWithUserConstraint($userSlug, $taskSlug);

        flash()->success('Your task was successfully destroyed.');

        return redirect()->route('users.dashboard', $userSlug);
    }

    /**
     * Mark a task a completed.
     *
     * @param $userSlug
     * @param $taskSlug
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function complete($userSlug, $taskSlug)
    {
        $this->taskRepo->complete($userSlug, $taskSlug);

        flash()->success('You changed the completed status of this task.');

        return redirect()->back();
    }

}
