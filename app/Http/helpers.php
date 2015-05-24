<?php

function sort_tasks_by($column, $body)
{
    $direction = (Request::get('direction') == 'asc') ? 'desc' : 'asc';
    return link_to_route('admin.manage.tasks', $body, ['sortBy' => $column, 'direction' => $direction]);
}

function sort_accounts_by($column, $body)
{
    $direction = (Request::get('direction') == 'asc') ? 'desc' : 'asc';
    return link_to_route('admin.active.accounts', $body, ['sortBy' => $column, 'direction' => $direction]);
}