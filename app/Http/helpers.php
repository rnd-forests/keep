<?php

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

define('TASK_VIEW', 'admin::tasks.published');
define('ACCOUNT_VIEW', 'admin::members.active');

if (!function_exists('carbon')) {
    /**
     * Return a new instance of the Carbon library class.
     *
     * @return mixed
     */
    function carbon()
    {
        return app()->make(Carbon::class);
    }
}

if (!function_exists('sort_tasks_by')) {
    /**
     * Generate URL for sorting tasks.
     *
     * @param $attribute
     * @param $text
     *
     * @return string
     */
    function sort_tasks_by($attribute, $text)
    {
        return link_to_route(TASK_VIEW, $text, [
            'sortBy' => $attribute,
            'direction' => (request()->get('direction') == 'asc') ? 'desc' : 'asc',
        ]);
    }
}

if (!function_exists('sort_accounts_by')) {
    /**
     * Generate URL for sorting accounts.
     *
     * @param $attribute
     * @param $text
     *
     * @return string
     */
    function sort_accounts_by($attribute, $text)
    {
        return link_to_route(ACCOUNT_VIEW, $text, [
            'sortBy' => $attribute,
            'direction' => (request()->get('direction') == 'asc') ? 'desc' : 'asc',
        ]);
    }
}

if (!function_exists('short_time')) {
    /**
     * Return a short format of a timestamp.
     *
     * @param $timestamp
     *
     * @return string
     */
    function short_time($timestamp)
    {
        return carbon()->parse($timestamp)->format('Y-m-d');
    }
}

if (!function_exists('full_time')) {
    /**
     * Return a full format of a timestamp.
     *
     * @param $timestamp
     *
     * @return string
     */
    function full_time($timestamp)
    {
        return carbon()->parse($timestamp)->format('Y-m-d, H:i:s');
    }
}

if (!function_exists('humans_time')) {
    /**
     * Return the human-friendly difference time interval.
     *
     * @param $timestamp
     *
     * @return string
     */
    function humans_time($timestamp)
    {
        return carbon()->parse($timestamp)->diffForHumans();
    }
}

if (!function_exists('plural')) {
    /**
     * Plural a word using the associated counter value.
     *
     * @param $pattern
     * @param $counter
     *
     * @return string
     */
    function plural($pattern, $counter)
    {
        if (!is_numeric($counter)) {
            throw new InvalidArgumentException();
        }

        return $counter.' '.str_plural($pattern, $counter);
    }
}

if (!function_exists('plural2')) {
    /**
     * Plural a word using the associated counter
     * value with a middle pattern.
     *
     * @param $pattern
     * @param $middle
     * @param $counter
     *
     * @return string
     */
    function plural2($pattern, $middle, $counter)
    {
        if (!is_numeric($counter)) {
            throw new InvalidArgumentException();
        }

        return $counter.' '.$middle.' '.str_plural($pattern, $counter);
    }
}

if (!function_exists('remaining_days')) {
    /**
     * Get the difference in days between a specified
     * timestamp and current time.
     *
     * @param $finish
     *
     * @return string
     */
    function remaining_days($finish)
    {
        $count = (int) carbon()->now()->diffInDays(carbon()->parse($finish));

        return $count.' '.str_plural('day', $count).' remaining';
    }
}

if (!function_exists('counting')) {
    /**
     * Count the total number of instances inside a collection or a
     * paginated collection.
     *
     * @param $object
     *
     * @return int
     */
    function counting($object)
    {
        if (!($object instanceof Collection or $object instanceof LengthAwarePaginator)) {
            throw new InvalidArgumentException();
        }

        if ($object instanceof LengthAwarePaginator) {
            return $object->total();
        }

        return $object->count();
    }
}

if (!function_exists('print_attr')) {
    /**
     * Print attribute of object or return a default value.
     *
     * @param $attribute
     *
     * @return string
     */
    function print_attr($attribute)
    {
        if (empty($attribute)) {
            return '-';
        }

        return $attribute;
    }
}

if (!function_exists('blank')) {
    /**
     * Check if a collection or a paginated
     * collection is empty or not.
     *
     * @param $object
     *
     * @return bool
     */
    function blank($object)
    {
        if (!($object instanceof Collection or $object instanceof LengthAwarePaginator)) {
            throw new InvalidArgumentException();
        }

        return $object->isEmpty();
    }
}

if (!function_exists('render_pagination')) {
    /**
     * Generate the pagination URL. There two cases:
     *  - The normal case with no query string.
     *  - And the paginate with some associated query strings.
     *
     * @param $collection
     * @param array|null $queries
     *
     * @return string
     */
    function render_pagination($collection, array $queries = null)
    {
        if (!$queries) {
            return '<div class="text-center">'.$collection->render().'</div>';
        } else {
            return '<div class="text-center">'.$collection->appends($queries)->render().'</div>';
        }
    }
}

if (!function_exists('zero')) {
    /**
     * Check for a "zeroed" value.
     *
     * @param $count
     *
     * @return bool
     */
    function zero($count)
    {
        return $count === 0;
    }
}

if (!function_exists('array_random_val')) {
    /**
     * Generate random values from a given array.
     *
     * @param array $arr
     *
     * @return mixed
     */
    function array_random_val(array $arr)
    {
        return $arr[array_rand($arr)];
    }
}

if (!function_exists('error_text')) {
    /**
     * Utility function to print out the error in forms.
     *
     * @param ViewErrorBag $errors
     * @param $field
     *
     * @return mixed
     */
    function error_text(ViewErrorBag $errors, $field)
    {
        if ($errors->has($field)) {
            return $errors->first($field, '<span class="help-block form-error-text">:message</span>');
        }
    }
}

if (!function_exists('get_class_short_name')) {
    /**
     * Return the short name of the class from the
     * fully qualified class name.
     *
     * @param $object
     *
     * @return string
     */
    function get_class_short_name($object)
    {
        if (!is_object($object)) {
            throw new InvalidArgumentException();
        }

        return (new ReflectionClass($object))->getShortName();
    }
}
