<?php

use Carbon\Carbon;

function sort_tasks_by($column, $body)
{
    $direction = (Request::get('direction') == 'asc') ? 'desc' : 'asc';

    return link_to_route('admin::tasks.published', $body, ['sortBy' => $column, 'direction' => $direction]);
}

function sort_accounts_by($column, $body)
{
    $direction = (Request::get('direction') == 'asc') ? 'desc' : 'asc';

    return link_to_route('admin::members.active', $body, ['sortBy' => $column, 'direction' => $direction]);
}

function short_time($timestamp)
{
    return Carbon::parse($timestamp)->format('Y-m-d');
}

function full_time($timestamp)
{
    return Carbon::parse($timestamp)->format('Y-m-d, H:i:s');
}

function humans_time($timestamp)
{
    return Carbon::parse($timestamp)->diffForHumans();
}

function plural($pattern, $counter)
{
    return $counter . ' ' . str_plural($pattern, $counter);
}

function plural2($pattern, $middle, $counter)
{
    return $counter . ' ' . $middle . ' ' . str_plural($pattern, $counter);
}

function remaining_days($finish)
{
    $count = (int) Carbon::now()->diffInDays(Carbon::parse($finish), true);

    return $count . ' ' . str_plural('day', $count) . ' remaining';
}

function counting($object)
{
    return $object->count();
}

function print_attr($attribute)
{
    if (empty($attribute)) {
        return '-';
    }

    return $attribute;
}

function blank($object)
{
    return $object->isEmpty();
}

function render_pagination($collection)
{
    return '<div class="text-center">' . $collection->render() . '</div>';
}