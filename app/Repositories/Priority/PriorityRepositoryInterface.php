<?php namespace Keep\Repositories\Priority;

interface PriorityRepositoryInterface {

    public function getAll();

    public function lists();

    public function findByName($name);

    public function getTasksOfUserAssociatedWithAPriority($userSlug, $priorityName, $limit);

}