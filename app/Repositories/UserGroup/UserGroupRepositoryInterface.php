<?php
namespace Keep\Repositories\UserGroup;

interface UserGroupRepositoryInterface
{
    public function fetchPaginatedGroups($limit);

    public function findBySlug($slug);

    public function create(array $data);

    public function update($slug, array $data);

    public function restore($slug);

    public function softDelete($slug);

    public function forceDelete($slug);

    public function fetchTrashedGroups($limit);

    public function findTrashedGroupBySlug($slug);

    public function fetchPaginatedAssociatedUsers($group, $limit);

    public function fetchOutsiders($slug);

    public function attachUsers($group, array $users);

    public function fetchGroupsByIds(array $ids);

    public function fetchGroupsOfUser($userSlug);

    public function fetchMembersOfGroup($groupSlug);

    public function fetchAssignmentsOfGroup($groupSlug);
}
