<?php

namespace Keep\Search\Contracts;

interface SearchInterface
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