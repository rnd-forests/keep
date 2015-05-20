<?php namespace Keep\Services;

use Keep\Entities\Group;

class KeepHelper {

    /**
     * Pluck all ids of users associated with a given group.
     *
     * @param Group $group
     *
     * @return array
     */
    public static function getIdsOfUsersInRelationWithGroup(Group $group)
    {
        return $group->users->fetch('id')->toArray();
    }

    /**
     * Pluck all ids of assignments associated with a given group.
     *
     * @param Group $group
     *
     * @return mixed
     */
    public static function getIdsOfAssignmentsInRelationWithGroup(Group $group)
    {
        return $group->assignments->fetch('id')->toArray();
    }

}