<?php

namespace Keep\Http\Controllers\Member;

use Illuminate\Http\Request;
use Keep\Events\TaskHasPublished;
use Keep\Http\Requests\TaskRequest;
use Keep\Http\Controllers\Controller;
use Keep\Repositories\Task\TaskRepositoryInterface as TaskRepo;
use Keep\Repositories\User\UserRepositoryInterface as UserRepo;

class TasksController extends Controller
{
    protected $userRepo, $taskRepo;

    /**
     * Create a new user-task controller instance.
     *
     * @param UserRepo $userRepo
     * @param TaskRepo $taskRepo
     */
    public function __construct(UserRepo $userRepo, TaskRepo $taskRepo)
    {
        $this->userRepo = $userRepo;
        $this->taskRepo = $taskRepo;
        $this->middleware('auth');
        $this->middleware('auth.correct');
    }

    /**
     * Get form to create new task.
     *
     * @param $userSlug
     * @return \Illuminate\View\View
     */
    public function create($userSlug)
    {
        $user = $this->userRepo->findBySlug($userSlug);

        return view('users.tasks.create', compact('user'));
    }

    /**
     * Persist a new task.
     *
     * @param $userSlug
     * @param TaskRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($userSlug, TaskRequest $request)
    {
        $author = $this->userRepo->findBySlug($userSlug);
        $task = $author->tasks()->save($this->createTask($request));
        event(new TaskHasPublished($author, $task));
        flash()->success(trans('controller.task_created'));

        return redirect()->route('member::dashboard', $author);
    }

    /**
     * Create new task.
     *
     * @param TaskRequest $request
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
     * @param $task
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
     * @param $userSlug
     * @param $taskSlug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TaskRequest $request, $userSlug, $taskSlug)
    {
        $task = $this->taskRepo->update($request->all(), $userSlug, $taskSlug);
        $this->setRelations($task, $request);
        flash()->info(trans('controller.task_updated'));

        return redirect()->route('member::dashboard', $this->userRepo->findBySlug($userSlug));
    }

    /**
     * Delete a task.
     *
     * @param $userSlug
     * @param $taskSlug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($userSlug, $taskSlug)
    {
        $this->taskRepo->deleteWithUserConstraint($userSlug, $taskSlug);
        flash()->success(trans('controller.task_deleted'));

        return redirect()->route('member::dashboard', $userSlug);
    }

    /**
     * Mark a task a completed.
     *
     * @param Request $request
     * @param $userSlug
     * @param $taskSlug
     */
    public function complete(Request $request, $userSlug, $taskSlug)
    {
        $task = $this->taskRepo->complete($request, $userSlug, $taskSlug);

        return $task->toJson();
    }
}
