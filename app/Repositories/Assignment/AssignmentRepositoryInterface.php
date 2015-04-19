<?php namespace Keep\Repositories\Assignment;

interface AssignmentRepositoryInterface {

    /**
     * Create a new assignment.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data);

}