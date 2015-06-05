<?php namespace Keep\Repositories\UserGroup;

use Keep\Entities\Group;

interface UserGroupRepositoryInterface {

    public function getPaginatedGroups($limit);
    
    public function findBySlug($slug);

    public function create(array $data);

    public function update($slug, array $data);

    public function restore($slug);

    public function softDelete($slug);

    public function forceDelete($slug);

    public function getTrashedGroups($limit);

    public function findTrashedGroupBySlug($slug);

    public function getPaginatedAssociatedUsers(Group $group, $limit);

    public function getUsersOutsideGroup($slug);

    public function attachUsers(Group $group, array $users);

    public function fetchGroupsByIds(array $ids);

    public function getGroupsAssociatedWithAUser($userSlug);

    public function getMembersOfGroup($groupSlug);

    public function getAssignmentsOfGroup($groupSlug);

}