<?php

Route::group(['prefix' => '{users}', 'as' => 'member::', 'namespace' => 'Member'], function () {
    Route::get('profile', [
        'as'   => 'profile',
        'uses' => 'ProfileController@show',
    ]);

    Route::match(['put', 'patch'], '', [
        'as'   => 'update',
        'uses' => 'ProfileController@update',
    ]);

    Route::delete('', [
        'as'   => 'destroy',
        'uses' => 'ProfileController@destroy',
    ]);

    Route::get('dashboard', [
        'as'   => 'dashboard',
        'uses' => 'DashboardController@dashboard',
    ]);

    Route::get('tasks/all', [
        'as'   => 'tasks.all',
        'uses' => 'DashboardController@allTasks',
    ]);

    Route::get('tasks/completed', [
        'as'   => 'tasks.completed',
        'uses' => 'DashboardController@completedTasks',
    ]);

    Route::get('tasks/failed', [
        'as'   => 'tasks.failed',
        'uses' => 'DashboardController@failedTasks',
    ]);

    Route::get('tasks/due', [
        'as'   => 'tasks.due',
        'uses' => 'DashboardController@dueTasks',
    ]);

    Route::patch('tasks/{tasks}/complete', [
        'as'   => 'tasks.complete',
        'uses' => 'TasksController@complete',
    ]);

    Route::get('groups', [
        'as'   => 'groups.all',
        'uses' => 'GroupsController@index',
    ]);

    Route::get('groups/{groups}', [
        'as'   => 'groups.show',
        'uses' => 'GroupsController@show',
    ]);

    Route::get('tags', [
        'as'   => 'tags.all',
        'uses' => 'TagsController@index',
    ]);

    Route::get('tags/{tags}', [
        'as'   => 'tags.task',
        'uses' => 'TagsController@show',
    ]);

    Route::get('priorities', [
        'as'   => 'priorities.all',
        'uses' => 'PrioritiesController@index',
    ]);

    Route::get('priorities/{priorities}/tasks', [
        'as'   => 'priorities.task',
        'uses' => 'PrioritiesController@show',
    ]);

    Route::get('notifications', [
        'as'   => 'notifications.personal',
        'uses' => 'NotificationsController@fetchPersonalNotifications',
    ]);

    Route::get('group-notifications', [
        'as'   => 'notifications.group',
        'uses' => 'NotificationsController@fetchGroupNotifications',
    ]);

    Route::get('search', [
        'as'   => 'tasks.search',
        'uses' => 'SearchController@searchTasks',
    ]);
});

Route::group(['prefix' => '{users}', 'namespace' => 'Member'], function () {
    Route::resource('tasks', 'TasksController', [
        'except' => ['index'],
        'names'  => [
            'create'  => 'member::tasks.create',
            'store'   => 'member::tasks.store',
            'show'    => 'member::tasks.show',
            'edit'    => 'member::tasks.edit',
            'update'  => 'member::tasks.update',
            'destroy' => 'member::tasks.destroy',
        ],
    ]);
});
