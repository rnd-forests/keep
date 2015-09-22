<?php

Route::group(['middleware' => ['auth', 'valid.roles:admin'],
    'prefix' => 'admin',
    'as' => 'admin::',
    'namespace' => 'Admin'], function () {

    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@dashboard']);

    Route::group(['prefix' => 'members/disabled', 'as' => 'members.'], function () {
        Route::get('', ['as' => 'disabled', 'uses' => 'MembersDisabledController@index']);
        Route::put('{members}', ['as' => 'disabled.restore', 'uses' => 'MembersDisabledController@restore']);
        Route::delete('{members}', ['as' => 'disabled.delete', 'uses' => 'MembersDisabledController@destroy']);
    });
    Route::resource('members', 'MembersController', [
        'only' => ['index', 'show', 'destroy'],
        'names' => [
            'index' => 'members',
            'show' => 'members.show',
            'destroy' => 'members.delete'
        ]
    ]);

    Route::group(['prefix' => 'groups/trashed', 'as' => 'groups.trashed'], function () {
        Route::get('', ['as' => '', 'uses' => 'GroupsTrashedController@index']);
        Route::put('{groups}', ['as' => '.restore', 'uses' => 'GroupsTrashedController@restore']);
        Route::delete('{groups}', ['as' => '.delete', 'uses' => 'GroupsTrashedController@destroy']);
    });
    Route::resource('groups', 'GroupsController', [
        'names' => [
            'index' => 'groups',
            'create' => 'groups.create',
            'store' => 'groups.store',
            'show' => 'groups.show',
            'edit' => 'groups.edit',
            'update' => 'groups.update',
            'destroy' => 'groups.delete'
        ]
    ]);
    Route::get('groups/{groups}/add', ['as' => 'groups.add', 'uses' => 'GroupUserController@create']);
    Route::post('groups/{groups}/add', ['as' => 'groups.sync', 'uses' => 'GroupUserController@store']);
    Route::post('groups/{groups}/{users}', ['as' => 'groups.remove', 'uses' => 'GroupUserController@destroy']);
    Route::post('groups/{groups}', ['as' => 'groups.flush', 'uses' => 'GroupUserController@flush']);

    Route::group(['prefix' => 'tasks/trashed', 'as' => 'tasks.trashed'], function () {
        Route::get('', ['as' => '', 'uses' => 'TasksTrashedController@index']);
        Route::put('{tasks}', ['as' => '.restore', 'uses' => 'TasksTrashedController@restore']);
        Route::delete('{tasks}', ['as' => '.delete', 'uses' => 'TasksTrashedController@destroy']);
    });
    Route::resource('tasks', 'TasksController', [
        'only' => ['index', 'show', 'destroy'],
        'names' => [
            'index' => 'tasks',
            'show' => 'tasks.show',
            'destroy' => 'tasks.delete'
        ]
    ]);

    Route::get('notifications', ['as' => 'notifications', 'uses' => 'NotificationsController@index']);
    Route::delete('notifications/{notifications}', ['as' => 'notifications.delete', 'uses' => 'NotificationsController@destroy']);
    Route::get('notifications/member/create', ['as' => 'notifications.member.create', 'uses' => 'NotificationsController@createForMember']);
    Route::post('notifications/member', ['as' => 'notifications.member.store', 'uses' => 'NotificationsController@storeForMember']);
    Route::get('notifications/group/create', ['as' => 'notifications.group.create', 'uses' => 'NotificationsController@createForGroup']);
    Route::post('notifications/group', ['as' => 'notifications.group.store', 'uses' => 'NotificationsController@storeForGroup']);
});
