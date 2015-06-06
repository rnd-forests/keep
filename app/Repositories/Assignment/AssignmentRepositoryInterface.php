<?php
namespace Keep\Repositories\Assignment;

interface AssignmentRepositoryInterface
{
    public function getPaginatedAssignments($limit);

    public function findBySlug($slug);

    public function update($slug, array $data);

    public function delete($slug);

    public function create(array $data);

    public function syncPolymorphicRelations($assignment, $users, $groups);

    public function getGroupAssignmentsAssociatedWithAUser($userSlug);

    public function getAssignmentsAssociatedWithAUser($userSlug);

    public function findPersonalAssignment($userSlug, $assignmentSlug);

    public function findGroupAssignment($userSlug, $assignmentSlug);

    public function getTrashedAssignments($limit);

    public function findTrashedAssignmentBySlug($slug);

    public function restore($slug);

    public function forceDelete($slug);
}