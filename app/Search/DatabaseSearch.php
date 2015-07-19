<?php

namespace Keep\Search;

use Keep\Search\Contracts\SearchInterface;

class DatabaseSearch implements SearchInterface
{
    /**
     * Search for tasks by their titles.
     *
     * @param $user
     * @param $pattern
     * @return mixed
     */
    public function tasksByTitle($user, $pattern)
    {
        return $user->tasks()->search($pattern)->latest('created_at')->paginate(15);
    }
}