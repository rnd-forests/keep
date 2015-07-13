<?php

namespace Keep\Search\Contracts;

interface SearchInterface
{
    public function tasksByTitle($user, $pattern);
}