<?php namespace Keep\Http\Controllers;

use Keep\Http\Requests;
use Keep\Http\Requests\TaskRequest;
use Keep\Events\TaskWasCreatedEvent;
use Keep\Repositories\Task\TaskRepositoryInterface;
use Keep\Repositories\User\UserRepositoryInterface;

class UserTaskController extends Controller {

    /**
     * The user repository.
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * The task repository.
     * @var TaskRepositoryInterface
     */
    protected $taskRepository;

    /**
     * Create a new user-task controller instance.
     *
     * @param UserRepositoryInterface $userRepository
     * @param TaskRepositoryInterface $taskRepository
     */
    public function __construct(UserRepositoryInterface $userRepository,
                                TaskRepositoryInterface $taskRepository)
    {
        $this->userRepository = $userRepository;
        $this->taskRepository = $taskRepository;

        $this->middleware('auth');
        $this->middleware('auth.correct');
    }

    /**
     * Display all tasks of a user.
     *
     * @param $userSlug
     *
     * @return \Illuminate\View\View
     */
	public function index($userSlug)
	{
		$user = $this->userRepository->findBySlug($userSlug);

        $tasks = $this->userRepository->getPaginatedAssociatedTasks($user, 10);

        return view('tasks.index', compact('user', 'tasks'));
	}

    /**
     * Get the form to create new task.
     *
     * @return \Illuminate\View\View
     */
	public function create()
	{
        $user = $this->userRepository->getAuthUser();

		return view('tasks.create', compact('user'));
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
        $author = $this->userRepository->getAuthUser();

        $task = $author->tasks()->save($this->createTask($request));

        event(new TaskWasCreatedEvent($author, $task));

        flash()->success('Your tasks has been successfully created');

        return redirect()->route('users.tasks.index', $author->slug);
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
        $task = $this->taskRepository->findCorrectTaskBySlug($userSlug, $taskSlug);

        return view('tasks.show', compact('task'));
	}

    /**
     * Get the form to update a task.
     *
     * @param $userSlug
     * @param $taskSlug
     *
     * @return \Illuminate\View\View
     */
	public function edit($userSlug, $taskSlug)
	{
        $user = $this->userRepository->findBySlug($userSlug);

        $task = $this->taskRepository->findCorrectTaskBySlug($userSlug, $taskSlug);

		return view('tasks.edit', compact('user', 'task'));
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
        $task = $this->taskRepository->update($userSlug, $taskSlug, $request->all());

        $this->taskRepository->syncTags($task, $request->input('tag_list', []));

        flash()->info('Your task was successfully updated');

        return redirect()->route('users.tasks.index', $this->userRepository->getAuthUser()->slug);
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
		$this->taskRepository->deleteWithUserConstraint($userSlug, $taskSlug);

        flash()->success('Your task was successfully destroyed.');

        return redirect()->route('users.tasks.index', $userSlug);
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
        $task = $this->taskRepository->create($request->all());

        $this->taskRepository->syncTags($task, $request->input('tag_list', []));

        return $task;
    }

}
