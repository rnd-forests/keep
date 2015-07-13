<?php

Route::group(['prefix' => '{users}', 'as' => 'member::'], function () {
    Route::get('profile', [
        'as' => 'profile',
        'uses' => 'UsersController@show',
    ]);

    Route::match(['put', 'patch'], '', [
        'as' => 'update',
        'uses' => 'UsersController@update',
    ]);

    Route::delete('', [
        'as' => 'destroy',
        'uses' => 'UsersController@destroy',
    ]);

    Route::get('dashboard', [
        'as' => 'dashboard',
        'uses' => 'UserDashboardController@dashboard',
    ]);

    Route::get('tasks/all', [
        'as' => 'tasks.all',
        'uses' => 'UserDashboardController@allTasks',
    ]);

    Route::get('tasks/completed', [
        'as' => 'tasks.completed',
        'uses' => 'UserDashboardController@completedTasks',
    ]);

    Route::get('tasks/failed', [
        'as' => 'tasks.failed',
        'uses' => 'UserDashboardController@failedTasks',
    ]);

    Route::get('tasks/due', [
        'as' => 'tasks.due',
        'uses' => 'UserDashboardController@dueTasks',
    ]);

    Route::patch('tasks/{tasks}/complete', [
        'as' => 'tasks.complete',
        'uses' => 'UserTaskController@complete',
    ]);

    Route::get('groups', [
        'as' => 'groups.all',
        'uses' => 'UserGroupController@index',
    ]);

    Route::get('groups/{groups}', [
        'as' => 'groups.show',
        'uses' => 'UserGroupController@show',
    ]);

    Route::get('assignments', [
        'as' => 'assignments.all',
        'uses' => 'UserAssignmentController@index',
    ]);

    Route::get('personal-assignment/{assignments}', [
        'as' => 'assignments.personal.show',
        'uses' => 'UserAssignmentController@showPersonalAssignment',
    ]);

    Route::get('group-assignment/{assignments}', [
        'as' => 'assignments.group.show',
        'uses' => 'UserAssignmentController@showGroupAssignment',
    ]);

    Route::get('tags', [
        'as' => 'tags.all',
        'uses' => 'TagsController@index',
    ]);

    Route::get('tags/{tags}', [
        'as' => 'tags.task',
        'uses' => 'TagsController@show',
    ]);

    Route::get('priorities', [
        'as' => 'priorities.all',
        'uses' => 'PrioritiesController@index',
    ]);

    Route::get('priorities/{priorities}/tasks', [
        'as' => 'priorities.task',
        'uses' => 'PrioritiesController@show',
    ]);

    Route::get('notifications', [
        'as' => 'notifications.personal',
        'uses' => 'NotificationsController@fetchPersonalNotifications',
    ]);

    Route::get('group-notifications', [
        'as' => 'notifications.group',
        'uses' => 'NotificationsController@fetchGroupNotifications',
    ]);

    Route::get('search', [
        'as' => 'tasks.search',
        'uses' => 'SearchController@searchTasks',
    ]);
});

Route::group(['prefix' => '{users}'], function () {
    Route::resource('tasks', 'UserTaskController', [
        'except' => ['index'],
        'names' => [
            'create' => 'member::tasks.create',
            'store' => 'member::tasks.store',
            'show' => 'member::tasks.show',
            'edit' => 'member::tasks.edit',
            'update' => 'member::tasks.update',
            'destroy' => 'member::tasks.destroy',
        ],
    ]);
});
