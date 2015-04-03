<?php namespace Keep\Presenters;

use Carbon\Carbon;
use Laracasts\Presenter\Presenter;

class TaskPresenter extends Presenter {

    /**
     * Format task timestamps.
     *
     * @param $timestamp
     *
     * @return string
     */
    public function formatTaskTime($timestamp)
    {
        return Carbon::parse($timestamp)->format('Y-m-d');
    }

    /**
     * Task time difference for humans.
     *
     * @param $timestamp
     *
     * @return string
     */
    public function taskTimeForHumans($timestamp)
    {
        return 'Added ' . Carbon::parse($timestamp)->diffForHumans();
    }

    /**
     * Get task remaining days.
     *
     * @param $finish
     *
     * @return string
     */
    public function getRemainingDays($finish)
    {
        $count = (int) Carbon::now()->diffInDays(Carbon::parse($finish), true);

        return $count . " " . str_plural('day', $count) . ' remaining';
    }

    /**
     * Print task status.
     *
     * @param $completed
     *
     * @return string
     */
    public function printStatus($completed)
    {
        if ($completed)
        {
            return 'Completed';
        }

        return 'Not completed';
    }

}