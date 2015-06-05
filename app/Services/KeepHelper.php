<?php namespace Keep\Services;

use Keep\Entities\User;
use Keep\Entities\Group;

class KeepHelper {

    /**
     * Pluck all ids of users associated with a given group.
     *
     * @param Group $group
     *
     * @return array
     */
    public static function getUserIdsRelatedToGroup(Group $group)
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
    public static function getAssignmentIdsRelatedToGroup(Group $group)
    {
        return $group->assignments->fetch('id')->toArray();
    }

    /**
     * Pluck all ids of groups associated with a given user.
     *
     * @param User $user
     *
     * @return mixed
     */
    public static function getGroupIdsRelatedToUser(User $user)
    {
        return $user->groups->fetch('id')->toArray();
    }

}