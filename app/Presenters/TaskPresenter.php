<?php namespace Keep\Presenters;

use Carbon\Carbon;
use Laracasts\Presenter\Presenter;

class TaskPresenter extends Presenter {

    use KeepPresentableTrait;

    /**
     * Get task remaining days.
     *
     * @param $finish
     *
     * @return string
     */
    public function getRemainingDays($finish)
    {
        $count = (int)Carbon::now()->diffInDays(Carbon::parse($finish), true);

        return $count . ' ' . str_plural('day', $count) . ' remaining';
    }

    /**
     * Print task status.
     *
     * @param $status
     *
     * @return string
     */
    public function printStatus($status)
    {
        if ($status) return '<i class="text-primary fa fa-check"></i>';

        return '<i class="text-danger fa fa-times"></i>';
    }

    /**
     * Get the url to a task.
     *
     * @param $user
     * @param $task
     *
     * @return string
     */
    public function url($user, $task)
    {
        return route('users.tasks.show', [$user, $task]);
    }

}