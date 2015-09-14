<?php

namespace Keep\Http\Controllers\Member;

use Keep\Http\Controllers\Controller;
use Keep\Search\Contracts\SearchContract as SearchContract;
use Keep\Repositories\Contracts\UserRepositoryInterface as UserRepository;

class SearchController extends Controller
{
    protected $users, $search;

    public function __construct(UserRepository $users, SearchContract $search)
    {
        $this->users = $users;
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
        $pattern = app('request')->get('q');
        $user = $this->users->findBySlug($userSlug);
        $tasks = $this->search->tasksByTitle($user, $pattern);

        return view('users.tasks.search', compact('user', 'pattern', 'tasks'));
    }
}
