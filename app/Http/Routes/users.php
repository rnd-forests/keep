<?php

Route::group(['prefix' => '{users}', 'as' => 'member::', 'namespace' => 'Member'], function () {
    Route::get('profile', ['as' => 'profile.show', 'uses' => 'ProfileController@show']);
    Route::get('profile/edit', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::match(['put', 'patch'], '', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);

    Route::get('account', ['as' => 'account.show', 'uses' => 'AccountController@show']);
    Route::delete('', ['as' => 'account.destroy', 'uses' => 'AccountController@destroy']);
    Route::patch('change-name', ['as' => 'account.change.name', 'uses' => 'AccountController@changeName']);
    Route::patch('change-password', ['as' => 'account.change.password', 'uses' => 'AccountController@changePassword']);

    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@dashboard']);

    Route::get('tasks', ['as' => 'tasks', 'uses' => 'DashboardController@showTasks']);
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
