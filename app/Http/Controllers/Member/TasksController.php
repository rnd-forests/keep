<?php

namespace Http\Controllers\Member;

use Illuminate\Http\Request;
use Keep\Events\TaskHasPublished;
use Keep\Http\Requests\TaskRequest;
use Keep\Http\Controllers\Controller;
use Keep\Repositories\Task\TaskRepositoryInterface as TaskRepository;
use Keep\Repositories\User\UserRepositoryInterface as UserRepository;

class TasksController extends Controller
{
    protected $users, $tasks;

    public function __construct(UserRepository $users, TaskRepository $tasks)
    {
        $this->users = $users;
        $this->tasks = $tasks;
        $this->middleware('auth');
        $this->middleware('valid.user');
    }

    /**
     * Get form to create new task.
     *
     * @param $userSlug
     * @return \Illuminate\View\View
     */
    public function create($userSlug)
    {
        $user = $this->users->findBySlug($userSlug);

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
        $author = $this->users->findBySlug($userSlug);
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
        $task = $this->tasks->create($request->all());
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
        $this->tasks->syncTags($task, $request->input('tag_list', []));
        $this->tasks->associatePriority($task, $request->input('priority_level'));
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
        $user = $this->users->findBySlug($userSlug);
        $task = $this->tasks->findCorrectTaskBySlug($userSlug, $taskSlug);

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
        $user = $this->users->findBySlug($userSlug);
        $task = $this->tasks->findCorrectTaskBySlug($userSlug, $taskSlug);

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
        $task = $this->tasks->update($request->all(), $userSlug, $taskSlug);
        $this->setRelations($task, $request);
        flash()->info(trans('controller.task_updated'));

        return redirect()->route('member::dashboard', $this->users->findBySlug($userSlug));
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
        $this->tasks->deleteWithUserConstraint($userSlug, $taskSlug);
        flash()->success(trans('controller.task_deleted'));

        return redirect()->route('member::dashboard', $userSlug);
    }

    /**
     * Mark a task as completed.
     *
     * @param Request $request
     * @param $userSlug
     * @param $taskSlug
     */
    public function complete(Request $request, $userSlug, $taskSlug)
    {
        $task = $this->tasks->complete($request, $userSlug, $taskSlug);

        return $task->toJson();
    }
}
