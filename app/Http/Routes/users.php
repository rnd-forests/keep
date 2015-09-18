<?php

Route::group(['prefix' => '{users}', 'as' => 'member::', 'namespace' => 'Member'], function () {
    Route::get('profile', ['as' => 'profile', 'uses' => 'ProfileController@show']);
    Route::get('profile/edit', ['as' => 'edit-profile', 'uses' => 'ProfileController@edit']);
    Route::get('account', ['as' => 'account', 'uses' => 'ProfileController@account']);
    Route::match(['put', 'patch'], '', ['as' => 'update', 'uses' => 'ProfileController@update']);
    Route::delete('', ['as' => 'destroy', 'uses' => 'ProfileController@destroy']);
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@dashboard']);

    Route::get('tasks/all', ['as' => 'tasks.all', 'uses' => 'DashboardController@all']);
    Route::get('tasks/completed', ['as' => 'tasks.completed', 'uses' => 'DashboardController@completed']);
    Route::get('tasks/failed', ['as' => 'tasks.failed', 'uses' => 'DashboardController@failed']);
    Route::get('tasks/processing', ['as' => 'tasks.due', 'uses' => 'DashboardController@processing']);
    Route::patch('tasks/{tasks}/complete', ['as' => 'tasks.complete', 'uses' => 'TasksController@complete']);

    Route::get('groups', ['as' => 'groups.all', 'uses' => 'GroupsController@index']);
    Route::get('groups/{groups}', ['as' => 'groups.show', 'uses' => 'GroupsController@show']);

    Route::get('tags', ['as' => 'tags.all', 'uses' => 'TagsController@index']);
    Route::get('tags/{tags}', ['as' => 'tags.task', 'uses' => 'TagsController@show']);

    Route::get('priorities', ['as' => 'priorities.all', 'uses' => 'PrioritiesController@index']);
    Route::get('priorities/{priorities}/tasks', ['as' => 'priorities.task', 'uses' => 'PrioritiesController@show']);

    Route::get('notifications', ['as' => 'notifications', 'uses' => 'NotificationsController@fetchNotifications']);
    Route::get('search', ['as' => 'tasks.search', 'uses' => 'SearchController@searchTasks']);
});

Route::group(['prefix' => '{users}', 'namespace' => 'Member'], function () {
    Route::resource('tasks', 'TasksController', [
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
