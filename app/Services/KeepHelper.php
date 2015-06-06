<?php
namespace Keep\Services;

use Keep\Entities\User;
use Keep\Entities\Group;

class KeepHelper
{
    public static function getUserIdsRelatedToGroup(Group $group)
    {
        return $group->users->fetch('id')->toArray();
    }

    public static function getAssignmentIdsRelatedToGroup(Group $group)
    {
        return $group->assignments->fetch('id')->toArray();
    }

    public static function getGroupIdsRelatedToUser(User $user)
    {
        return $user->groups->fetch('id')->toArray();
    }
}