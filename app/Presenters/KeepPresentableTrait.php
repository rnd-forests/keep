<?php
namespace Keep\Presenters;

use Carbon\Carbon;

trait KeepPresentableTrait
{
    public function formatTime($timestamp)
    {
        return Carbon::parse($timestamp)->format('Y-m-d');
    }

    public function formatFullTime($timestamp)
    {
        return Carbon::parse($timestamp)->format('Y-m-d, H:i:s');
    }

    public function formatTimeForHumans($timestamp)
    {
        return Carbon::parse($timestamp)->diffForHumans();
    }
}