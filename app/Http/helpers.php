<?php

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

if (!function_exists('sort_tasks_by')) {
    function sort_tasks_by($column, $body)
    {
        $direction = (Request::get('direction') == 'asc') ? 'desc' : 'asc';

        return link_to_route('admin::tasks.published', $body, ['sortBy' => $column, 'direction' => $direction]);
    }
}

if (!function_exists('sort_accounts_by')) {
    function sort_accounts_by($column, $body)
    {
        $direction = (Request::get('direction') == 'asc') ? 'desc' : 'asc';

        return link_to_route('admin::members.active', $body, ['sortBy' => $column, 'direction' => $direction]);
    }
}

if (!function_exists('short_time')) {
    function short_time($timestamp)
    {
        return Carbon::parse($timestamp)->format('Y-m-d');
    }
}

if (!function_exists('full_time')) {
    function full_time($timestamp)
    {
        return Carbon::parse($timestamp)->format('Y-m-d, H:i:s');
    }
}

if (!function_exists('humans_time')) {
    function humans_time($timestamp)
    {
        return Carbon::parse($timestamp)->diffForHumans();
    }
}

if (!function_exists('plural')) {
    function plural($pattern, $counter)
    {
        if (!is_numeric($counter)) {
            throw new InvalidArgumentException;
        }

        return $counter . ' ' . str_plural($pattern, $counter);
    }
}

if (!function_exists('plural2')) {
    function plural2($pattern, $middle, $counter)
    {
        if (!is_numeric($counter)) {
            throw new InvalidArgumentException;
        }

        return $counter . ' ' . $middle . ' ' . str_plural($pattern, $counter);
    }
}

if (!function_exists('remaining_days')) {
    function remaining_days($finish)
    {
        $count = (int)Carbon::now()->diffInDays(Carbon::parse($finish));

        return $count . ' ' . str_plural('day', $count) . ' remaining';
    }
}

if (!function_exists('counting')) {
    function counting($object)
    {
        if (!($object instanceof Collection or $object instanceof LengthAwarePaginator)) {
            throw new InvalidArgumentException;
        }

        return $object->count();
    }
}

if (!function_exists('print_attr')) {
    function print_attr($attribute)
    {
        if (empty($attribute)) {
            return '-';
        }

        return $attribute;
    }
}

if (!function_exists('blank')) {
    function blank($object)
    {
        if (!($object instanceof Collection or $object instanceof LengthAwarePaginator)) {
            throw new InvalidArgumentException;
        }

        return $object->isEmpty();
    }
}

if (!function_exists('render_pagination')) {
    function render_pagination($collection)
    {
        return '<div class="text-center">' . $collection->render() . '</div>';
    }
}

if (!function_exists('zero')) {
    function zero($count)
    {
        if (!is_numeric($count)) {
            throw new InvalidArgumentException;
        }

        return $count == 0;
    }
}

if (!function_exists('array_random_val')) {
    function array_random_val(array $arr)
    {
        return $arr[array_rand($arr)];
    }
}

if (!function_exists('error_text')) {
    function error_text($errors, $field)
    {
        if ($errors->has($field)) {
            return $errors->first($field, '<span class="help-block form-error-text">:message</span>');
        }
    }
}

if (!function_exists('get_class_short_name')) {
    function get_class_short_name($object)
    {
        return (new ReflectionClass($object))->getShortName();
    }
}
