<?php

namespace Keep\Services;

use Illuminate\Contracts\Auth\Guard;

class UserDashboard
{
    protected $currentUser;

    public function __construct(Guard $auth)
    {
        $this->currentUser = $auth->user();
    }

    /**
     * Count the number of all tasks for current authenticated user.
     *
     * @return int
     */
    public function totalTasks()
    {
        return $this->currentUser->tasks()->count();
    }

    /**
     * Count the number of completed tasks for current authenticated user.
     *
     * @return int
     */
    public function countCompletedTasks()
    {
        return $this->currentUser->tasks()->completed()->count();
    }

    /**
     * Count the number of failed tasks for current authenticated user.
     *
     * @return int
     */
    public function countFailedTasks()
    {
        return $this->currentUser->tasks()->recentlyFailed()->count();
    }

    /**
     * Count the number of processing tasks for current authenticated user.
     *
     * @return int
     */
    public function countDueTasks()
    {
        return $this->currentUser->tasks()->due()->count();
    }

    /**
     * Return the percentage of completed tasks.
     *
     * @return float
     */
    public function completedPercentage()
    {
        return round($this->currentUser->tasks()->completed()->count() /
            $this->currentUser->tasks()->count() * 100);
    }

    /**
     * Return the percentage of processing tasks.
     *
     * @return float
     */
    public function processingPercentage()
    {
        return round($this->currentUser->tasks()->due()->count() /
            $this->currentUser->tasks()->count() * 100);
    }

    /**
     * Count the total number of urgent priority tasks of a user.
     *
     * @return int
     */
    public function countUrgentPriorityTasks()
    {
        return $this->currentUser->tasks()->urgent()->count();
    }

    /**
     * Count the total number of high priority tasks of a user.
     *
     * @return int
     */
    public function countHighPriorityTasks()
    {
        return $this->currentUser->tasks()->high()->count();
    }

    /**
     * Count the total number of normal priority tasks of a user.
     *
     * @return int
     */
    public function countNormalPriorityTasks()
    {
        return $this->currentUser->tasks()->normal()->count();
    }

    /**
     * Count the total number of low priority tasks of a user.
     *
     * @return int
     */
    public function countLowPriorityTasks()
    {
        return $this->currentUser->tasks()->low()->count();
    }
}
