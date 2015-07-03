<?php

namespace Keep\Repositories\Assignment;

interface AssignmentRepositoryInterface
{
    public function fetchPaginatedAssignments($limit);
    public function findBySlug($slug);
    public function create(array $data);
    public function update($slug, array $data);
    public function softDelete($slug);
    public function restore($slug);
    public function forceDelete($slug);
    public function syncPolymorphicRelations($assignment, $users, $groups);
    public function fetchGroupAssignmentsOfAUser($userSlug);
    public function fetchAssignmentsOfAUser($userSlug);
    public function findPersonalAssignment($userSlug, $assignmentSlug);
    public function findGroupAssignment($userSlug, $assignmentSlug);
    public function fetchTrashedAssignments($limit);
    public function findTrashedAssignmentBySlug($slug);
}
