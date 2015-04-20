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
     * @param $completed
     *
     * @return string
     */
    public function printStatus($completed)
    {
        if ($completed) return 'yes';

        return 'no';
    }

}