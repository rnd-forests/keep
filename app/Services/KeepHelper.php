<?php  namespace Keep\Services; 

use Keep\Group;

class KeepHelper {

    /**
     * Pluck all ids of users associated with a given group.
     *
     * @param Group $group
     * @return array
     */
    public static function getIdsOfUsersInRelationWithGroup(Group $group)
    {
        return array_fetch($group->users()->select('id')->get()->toArray(), 'id');
    }

}