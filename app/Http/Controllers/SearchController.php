<?php

namespace Keep\Http\Controllers;

use Keep\Search\Contracts\SearchInterface;
use Keep\Repositories\User\UserRepositoryInterface;

class SearchController extends Controller
{
    protected $userRepo, $search;

    /**
     * Create new instance of search controller.
     *
     * @param UserRepositoryInterface $userRepo
     * @param SearchInterface $search
     */
    public function __construct(UserRepositoryInterface $userRepo, SearchInterface $search)
    {
        $this->userRepo = $userRepo;
        $this->search = $search;
    }

    /**
     * Search tasks of a user by their titles.
     *
     * @param $userSlug
     * @return \Illuminate\View\View
     */
    public function searchTasks($userSlug)
    {
        $user = $this->userRepo->findBySlug($userSlug);
        $pattern = app('request')->get('q');
        $tasks = $this->search->tasksByTitle($user, $pattern);

        return view('users.search', compact('user', 'pattern', 'tasks'));
    }
}
