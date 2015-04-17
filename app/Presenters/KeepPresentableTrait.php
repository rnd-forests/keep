<?php namespace Keep\Presenters;

use Carbon\Carbon;

trait KeepPresentableTrait {

    /**
     * Format timestamp.
     *
     * @param $timestamp
     *
     * @return string
     */
    public function formatTime($timestamp)
    {
        return Carbon::parse($timestamp)->format('Y-m-d');
    }

    /**
     * Format full timestamp.
     *
     * @param $timestamp
     *
     * @return string
     */
    public function formatFullTime($timestamp)
    {
        return Carbon::parse($timestamp)->format('Y-m-d, H:i:s');
    }

    /**
     * Time difference for humans.
     *
     * @param $timestamp
     *
     * @return string
     */
    public function formatTimeForHumans($timestamp)
    {
        return Carbon::parse($timestamp)->diffForHumans();
    }

}