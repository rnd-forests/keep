<?php

namespace Keep\Entities\Concerns;

trait TaskScopes
{
    public function scopeUrgent($query)
    {
        return $query
            ->where('priority_id', 1)
            ->where('completed', false)
            ->where('is_failed', false)
            ->orderBy('finishing_date', 'asc');
    }

    public function scopeCompleted($query)
    {
        return $query->where('completed', true);
    }

    public function scopeDeadline($query)
    {
        return $query
            ->where('completed', false)
            ->where('is_failed', false)
            ->orderBy('finishing_date', 'asc');
    }

    public function scopeRecentlyCompleted($query)
    {
        return $query
            ->where('completed', true)
            ->orderBy('finished_at', 'desc');
    }

    public function scopeAboutToFail($query)
    {
        return $query
            ->where('completed', false)
            ->where('is_failed', false)
            ->where('finishing_date', '<', Carbon::now());
    }

    public function scopeRecentlyFailed($query)
    {
        return $query
            ->where('is_failed', true)
            ->orderBy('created_at', 'desc');
    }

    public function scopeDue($query)
    {
        return $query
            ->where('is_failed', false)
            ->where('completed', false);
    }

    public function scopeUserCreated($query)
    {
        return $query->where('user_id', '<>', 0);
    }

    public function scopeUpcoming($query)
    {
        return $query
            ->where('completed', false)
            ->where('is_failed', false)
            ->whereBetween('finishing_date', [Carbon::now(), Carbon::now()->addDays(5)]);
    }

    public function scopeSearch($query, $pattern)
    {
        return $query->where('title', 'LIKE', "%$pattern%");
    }
}