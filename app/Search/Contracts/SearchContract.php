<?php

namespace Keep\Search\Contracts;

interface SearchContract
{
    /**
     * Search for tasks by their titles.
     *
     * @param $user
     * @param $pattern
     * @return mixed
     */
    public function tasksByTitle($user, $pattern);
}
