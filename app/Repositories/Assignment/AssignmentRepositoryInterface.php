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

    /**
     * Get all assignments of groups that a user belongs to.
     *
     * @param $userSlug
     *
     * @return mixed
     */
    public function getGroupAssignmentsAssociatedWithAUser($userSlug);

    /**
     * Get all personal assignments of a user.
     *
     * @param $userSlug
     *
     * @return mixed
     */
    public function getAssignmentsAssociatedWithAUser($userSlug);

    /**
     * Find a personal assignment of a user.
     *
     * @param $userSlug
     * @param $assignmentSlug
     *
     * @return mixed
     */
    public function findPersonalAssignment($userSlug, $assignmentSlug);

    /**
     * Find a group assignment of a user.
     *
     * @param $userSlug
     * @param $assignmentSlug
     *
     * @return mixed
     */
    public function findGroupAssignment($userSlug, $assignmentSlug);

    /**
     * Fetch trashed assignments.
     *
     * @param $limit
     *
     * @return mixed
     */
    public function getTrashedAssignments($limit);

    /**
     * Find a trashed assignment by its slug.
     *
     * @param $slug
     *
     * @return mixed
     */
    public function findTrashedAssignmentBySlug($slug);

    /**
     * Restore a trashed assignment.
     *
     * @param $slug
     *
     * @return mixed
     */
    public function restore($slug);

    /**
     * Force delete an assignment.
     *
     * @param $slug
     *
     * @return mixed
     */
    public function forceDelete($slug);

}