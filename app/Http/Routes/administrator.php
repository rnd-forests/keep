<?php

Route::group([
    'middleware' => ['auth', 'valid.roles:admin'],
    'prefix' => 'admin',
    'as' => 'admin::',
    'namespace' => 'Admin', ], function () {

    Route::get('dashboard', [
        'as' => 'dashboard',
        'uses' => 'DashboardController@dashboard',
    ]);

    Route::group(['prefix' => 'members', 'as' => 'members.'], function () {
        Route::get('active', [
            'as' => 'active',
            'uses' => 'UsersController@activeAccounts',
        ]);

        Route::get('active/{users}', [
            'as' => 'active.profile',
            'uses' => 'UsersController@profile',
        ]);

        Route::delete('active/{users}', [
            'as' => 'active.disable',
            'uses' => 'UsersController@disableAccount',
        ]);

        Route::get('disabled', [
            'as' => 'disabled',
            'uses' => 'UsersController@disabledAccounts',
        ]);

        Route::put('disabled/{users}', [
            'as' => 'disabled.restore',
            'uses' => 'UsersController@restoreAccount',
        ]);

        Route::delete('disabled/{users}', [
            'as' => 'disabled.force.delete',
            'uses' => 'UsersController@forceDeleteAccount',
        ]);
    });

    Route::group(['prefix' => 'groups/active', 'as' => 'groups.active'], function () {
        Route::get('', [
            'as' => '',
            'uses' => 'UserGroupsController@activeGroups',
        ]);

        Route::get('create', [
            'as' => '.create',
            'uses' => 'UserGroupsController@create',
        ]);

        Route::post('', [
            'as' => '.store',
            'uses' => 'UserGroupsController@store',
        ]);

        Route::get('{groups}', [
            'as' => '.show',
            'uses' => 'UserGroupsController@show',
        ]);

        Route::get('{groups}/add', [
            'as' => '.add.users',
            'uses' => 'UserGroupsController@addUsers',
        ]);

        Route::post('{groups}/add', [
            'as' => '.sync.users',
            'uses' => 'UserGroupsController@storeNewUsers',
        ]);

        Route::post('{groups}/{users}', [
            'as' => '.remove.users',
            'uses' => 'UserGroupsController@removeUser',
        ]);

        Route::get('{groups}/edit', [
            'as' => '.edit',
            'uses' => 'UserGroupsController@edit',
        ]);

        Route::post('{groups}', [
            'as' => '.flush',
            'uses' => 'UserGroupsController@flush',
        ]);

        Route::patch('{groups}', [
            'as' => '.update',
            'uses' => 'UserGroupsController@update',
        ]);

        Route::delete('{groups}', [
            'as' => '.delete',
            'uses' => 'UserGroupsController@destroy',
        ]);
    });

    Route::group(['prefix' => 'groups/trashed', 'as' => 'groups.trashed'], function () {
        Route::get('', [
            'as' => '',
            'uses' => 'UserGroupsController@trashedGroups',
        ]);

        Route::put('{groups}', [
            'as' => '.restore',
            'uses' => 'UserGroupsController@restore',
        ]);

        Route::delete('{groups}', [
            'as' => '.force.delete',
            'uses' => 'UserGroupsController@forceDeleteGroup',
        ]);
    });

    Route::group(['prefix' => 'tasks/published', 'as' => 'tasks.published'], function () {
        Route::get('', [
            'as' => '',
            'uses' => 'TasksController@activeTasks',
        ]);

        Route::get('{tasks}', [
            'as' => '.show',
            'uses' => 'TasksController@showTask',
        ]);

        Route::delete('{tasks}', [
            'as' => '.delete',
            'uses' => 'TasksController@softDelete',
        ]);
    });

    Route::group(['prefix' => 'tasks/trashed', 'as' => 'tasks.trashed'], function () {
        Route::get('', [
            'as' => '',
            'uses' => 'TasksController@trashedTasks',
        ]);

        Route::put('{tasks}', [
            'as' => '.restore',
            'uses' => 'TasksController@restoreTask',
        ]);

        Route::delete('{tasks}', [
            'as' => '.force.delete',
            'uses' => 'TasksController@forceDeleteTask',
        ]);
    });

    Route::group(['prefix' => 'assignments/published', 'as' => 'assignments.published'], function () {
        Route::get('', [
            'as' => '',
            'uses' => 'AssignmentsController@index',
        ]);

        Route::get('{assignments}', [
            'as' => '.show',
            'uses' => 'AssignmentsController@show',
        ]);

        Route::get('{assignments}/edit', [
            'as' => '.edit',
            'uses' => 'AssignmentsController@edit',
        ]);

        Route::patch('{assignments}', [
            'as' => '.update',
            'uses' => 'AssignmentsController@update',
        ]);

        Route::delete('{assignments}', [
            'as' => '.delete',
            'uses' => 'AssignmentsController@destroy',
        ]);
    });

    Route::group(['prefix' => 'assignments/member', 'as' => 'assignments.member'], function () {
        Route::get('create', [
            'as' => '.create',
            'uses' => 'AssignmentsController@createMemberAssignment',
        ]);

        Route::post('', [
            'as' => '.store',
            'uses' => 'AssignmentsController@storeMemberAssignment',
        ]);
    });

    Route::group(['prefix' => 'assignments/group', 'as' => 'assignments.group'], function () {
        Route::get('create', [
            'as' => '.create',
            'uses' => 'AssignmentsController@createGroupAssignment',
        ]);

        Route::post('', [
            'as' => '.store',
            'uses' => 'AssignmentsController@storeGroupAssignment',
        ]);
    });

    Route::group(['prefix' => 'assignments/trashed', 'as' => 'assignments.trashed'], function () {
        Route::get('', [
            'as' => '',
            'uses' => 'AssignmentsController@trashedAssignments',
        ]);

        Route::put('{assignments}', [
            'as' => '.restore',
            'uses' => 'AssignmentsController@restore',
        ]);

        Route::delete('{assignments}', [
            'as' => '.force.delete',
            'uses' => 'AssignmentsController@forceDeleteAssignment',
        ]);
    });

    Route::get('notifications', [
        'as' => 'notifications.all',
        'uses' => 'NotificationsController@index',
    ]);

    Route::delete('notifications/{notifications}', [
        'as' => 'notifications.delete',
        'uses' => 'NotificationsController@destroy',
    ]);

    Route::get('notifications/member/create', [
        'as' => 'notifications.member.create',
        'uses' => 'NotificationsController@createMemberNotification',
    ]);

    Route::post('notifications/member', [
        'as' => 'notifications.member.store',
        'uses' => 'NotificationsController@storeMemberNotification',
    ]);

    Route::get('notifications/group/create', [
        'as' => 'notifications.group.create',
        'uses' => 'NotificationsController@createGroupNotification',
    ]);

    Route::post('notifications/group', [
        'as' => 'notifications.group.store',
        'uses' => 'NotificationsController@storeGroupNotification',
    ]);
});
