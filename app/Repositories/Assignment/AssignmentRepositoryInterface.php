<?php namespace Keep\Repositories\Assignment;

interface AssignmentRepositoryInterface {

    /**
     * Get the paginated list of all assignments.
     *
     * @param $limit
     *
     * @return mixed
     */
    public function getPaginatedAssignments($limit);

    /**
     * Find a assignment by its slug.
     *
     * @param $slug
     *
     * @return mixed
     */
    public function findBySlug($slug);

    /**
     * Update an existing assignment.
     *
     * @param       $slug
     * @param array $data
     *
     * @return mixed
     */
    public function update($slug, array $data);

    /**
     * Delete an assignment.
     *
     * @param $slug
     *
     * @return mixed
     */
    public function delete($slug);

    /**
     * Create a new assignment.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data);

    /**
     * Sync up all polymorphic relations associated with a specific assignment.
     *
     * @param $assignment
     * @param $users
     * @param $groups
     *
     * @return mixed
     */
    public function syncPolymorphicRelations($assignment, $users, $groups);

}