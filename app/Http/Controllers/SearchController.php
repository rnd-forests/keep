<?php

namespace Keep\Http\Controllers;

use Keep\Repositories\User\UserRepositoryInterface;
use Keep\Repositories\Task\TaskRepositoryInterface;

class SearchController extends Controller
{
    protected $userRepo, $taskRepo;

    /**
     * Create new instance of search controller.
     *
     * @param UserRepositoryInterface $userRepo
     * @param TaskRepositoryInterface $taskRepo
     */
    public function __construct(UserRepositoryInterface $userRepo, TaskRepositoryInterface $taskRepo)
    {
        $this->userRepo = $userRepo;
        $this->taskRepo = $taskRepo;
    }

    /**
     * Search tasks of a user by their titles.
     *
     * @param $userSlug
     *
     * @return \Illuminate\View\View
     */
    public function searchTasks($userSlug)
    {
        $user = $this->userRepo->findBySlug($userSlug);
        $pattern = app('request')->get('q');
        $tasks = $this->taskRepo->searchByTitle($user, $pattern);

        return view('users.search', compact('user', 'pattern', 'tasks'));
    }
}
