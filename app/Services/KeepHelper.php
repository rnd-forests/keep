<?php  namespace Keep\Services; 

use Keep\User;

class KeepHelper {

    /**
     * Pluck all ids of tasks associated with a given user.
     *
     * @param User $user
     * @return array
     */
    public static function getIdsOfTasksInRelation(User $user)
    {
        return array_fetch($user->tasks()->select('id')->get()->toArray(), 'id');
    }

}