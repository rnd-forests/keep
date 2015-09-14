<?php

namespace Keep\Repositories\Contracts;

interface GroupRepositoryInterface
{
    public function trashed($limit);
    public function findTrashedGroup($slug);
    public function associatedUsers($group, $limit);
    public function outsiders($slug);
    public function attachUsers($group, array $users);
    public function fetchByIds(array $ids);
    public function joinedGroups($userSlug);
    public function fetchMembers($groupSlug);
}
