<?php

namespace Keep\Entities\Scopes;

use Carbon\Carbon;

trait TaskScopes
{
    /**
     * Scope query for urgent tasks.
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUrgent($query)
    {
        return $query
            ->where('priority_id', 1)
            ->where('completed', false)
            ->where('is_failed', false)
            ->oldest('finishing_date');
    }

    /**
     * Scope query for high priority level tasks.
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHigh($query)
    {
        return $query
            ->where('priority_id', 2)
            ->where('completed', false)
            ->where('is_failed', false)
            ->oldest('finishing_date');
    }

    /**
     * Scope query for normal priority level tasks.
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNormal($query)
    {
        return $query
            ->where('priority_id', 3)
            ->where('completed', false)
            ->where('is_failed', false)
            ->oldest('finishing_date');
    }

    /**
     * Scope query for low priority level tasks.
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLow($query)
    {
        return $query
            ->where('priority_id', 4)
            ->where('completed', false)
            ->where('is_failed', false)
            ->oldest('finishing_date');
    }

    /**
     * Scope query for completed tasks.
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCompleted($query)
    {
        return $query->where('completed', true);
    }

    /**
     * Scope query for deadline tasks.
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDeadline($query)
    {
        return $query
            ->where('completed', false)
            ->where('is_failed', false)
            ->oldest('finishing_date');
    }

    /**
     * Scope query for recently completedt tasks.
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRecentlyCompleted($query)
    {
        return $query
            ->where('completed', true)
            ->latest('finished_at');
    }

    /**
     * Scope query for failed tasks.
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAboutToFail($query)
    {
        return $query
            ->where('completed', false)
            ->where('is_failed', false)
            ->where('finishing_date', '<', Carbon::now());
    }

    /**
     * Scope query for recently failed tasks.
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRecentlyFailed($query)
    {
        return $query
            ->where('is_failed', true)
            ->latest('created_at');
    }

    /**
     * Scope query for processing tasks.
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDue($query)
    {
        return $query
            ->where('is_failed', false)
            ->where('completed', false);
    }

    /**
     * Scope query for upcoming tasks.
     *
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUpcoming($query)
    {
        return $query
            ->where('completed', false)
            ->where('is_failed', false)
            ->whereBetween('finishing_date', [Carbon::now(), Carbon::now()->addDays(5)]);
    }

    /**
     * Search for tasks by title.
     *
     * @param $query
     * @param $pattern
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $pattern)
    {
        return $query->where('title', 'LIKE', "%$pattern%");
    }
}
