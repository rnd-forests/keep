<?php

namespace Keep\Repositories\Contracts;

interface PriorityRepositoryInterface
{
    public function fetchAll();
    public function lists();
    public function findByName($name);
    public function associatedTasks($userSlug, $priorityName, $limit);
}
