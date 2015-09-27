<?php

namespace Keep\Http\Controllers\Member;

use Keep\Http\Controllers\Controller;
use Keep\Repositories\Contracts\TagRepository;
use Keep\Repositories\Contracts\TaskRepository;
use Keep\Repositories\Contracts\UserRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DashboardController extends Controller
{
    protected $users, $tasks, $tags;

    public function __construct(UserRepository $users,
                                TaskRepository $tasks,
                                TagRepository $tags)
    {
        $this->users = $users;
        $this->tasks = $tasks;
        $this->tags = $tags;
        $this->middleware('auth');
        $this->middleware('valid.user');
    }

    /**
     * User dashboard.
     *
     * @param $userSlug
     * @return \Illuminate\View\View
     */
    public function dashboard($userSlug)
    {
        $user = $this->users->findBySlug($userSlug);
        $urgent = $this->tasks->urgentTasks($user);
        $deadline = $this->tasks->deadlineTasks($user);
        $tags = $this->tags->fetchAttachedTags($userSlug);
        $completed = $this->tasks->recentlyCompletedTasks($user);

        return view('users.dashboard.dashboard', compact(
            'user', 'urgent', 'deadline', 'completed', 'tags'));
    }

    /**
     * Fetching tasks according to types.
     *
     * @param $userSlug
     * @return \Illuminate\View\View
     */
    public function showTasks($userSlug)
    {
        $tasks = null;
        $type = request()->get('type');
        $user = $this->users->findBySlug($userSlug);
        $possibleTypes = ['all', 'completed', 'failed', 'processing'];

        if (!validate_query_string($type, $possibleTypes)) {
            throw new NotFoundHttpException;
        }

        switch ($type) {
            case 'all':
                $tasks = $this->tasks->allTasks($user);
                break;
            case 'completed':
                $tasks = $this->tasks->completedTasks($user);
                break;
            case 'failed':
                $tasks = $this->tasks->failedTasks($user);
                break;
            case 'processing':
                $tasks = $this->tasks->processingTasks($user);
                break;
        }

        return view('users.dashboard.task_collection', [
            'type' => ucfirst($type),
            'user' => $user,
            'tasks' => $tasks
        ]);
    }
}
