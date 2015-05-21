<?php

Route::group(['middleware' => ['auth', 'auth.confirmed', 'valid.admin.user'], 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('dashboard', [
        'as'   => 'admin.dashboard',
        'uses' => 'DashboardController@dashboard'
    ]);


    Route::get('active-members', [
        'as'   => 'admin.active.accounts',
        'uses' => 'UsersController@activeAccounts'
    ]);

    Route::get('active-members/{users}', [
        'as'   => 'admin.active.account.profile',
        'uses' => 'UsersController@profile'
    ]);

    Route::delete('active-members/{users}', [
        'as'   => 'admin.active.account.disable',
        'uses' => 'UsersController@disableAccount'
    ]);

    Route::get('disabled-members', [
        'as'   => 'admin.disabled.accounts',
        'uses' => 'UsersController@disabledAccounts'
    ]);

    Route::put('disabled-members/{users}', [
        'as'   => 'admin.restore.account',
        'uses' => 'UsersController@restoreAccount'
    ]);

    Route::delete('disabled-members/{users}', [
        'as'   => 'admin.force.delete.account',
        'uses' => 'UsersController@forceDeleteAccount'
    ]);


    Route::get('active-groups', [
        'as'   => 'admin.active.groups',
        'uses' => 'UserGroupsController@activeGroups'
    ]);

    Route::get('active-groups/create', [
        'as'   => 'admin.groups.create',
        'uses' => 'UserGroupsController@create'
    ]);

    Route::post('active-groups', [
        'as'   => 'admin.groups.store',
        'uses' => 'UserGroupsController@store'
    ]);

    Route::get('active-groups/{groups}', [
        'as'   => 'admin.groups.show',
        'uses' => 'UserGroupsController@show'
    ]);

    Route::get('active-groups/{groups}/add', [
        'as'   => 'admin.groups.add.users',
        'uses' => 'UserGroupsController@addUsers'
    ]);

    Route::post('active-groups/{groups}/add', [
        'as'   => 'admin.groups.sync.users',
        'uses' => 'UserGroupsController@storeNewUsers'
    ]);

    Route::post('active-groups/{groups}/{users}', [
        'as'   => 'admin.groups.remove.user',
        'uses' => 'UserGroupsController@removeUser'
    ]);

    Route::get('active-groups/{groups}/edit', [
        'as'   => 'admin.groups.edit',
        'uses' => 'UserGroupsController@edit'
    ]);

    Route::post('active-groups/{groups}', [
        'as'   => 'admin.groups.flush',
        'uses' => 'UserGroupsController@flush'
    ]);

    Route::patch('active-groups/{groups}', [
        'as'   => 'admin.groups.update',
        'uses' => 'UserGroupsController@update'
    ]);

    Route::delete('active-groups/{groups}', [
        'as'   => 'admin.groups.delete',
        'uses' => 'UserGroupsController@destroy'
    ]);

    Route::get('trashed-groups', [
        'as'   => 'admin.trashed.groups',
        'uses' => 'UserGroupsController@trashedGroups'
    ]);

    Route::put('trashed-groups/{groups}', [
        'as'   => 'admin.groups.restore',
        'uses' => 'UserGroupsController@restore'
    ]);

    Route::delete('trashed-groups/{groups}', [
        'as'   => 'admin.force.delete.group',
        'uses' => 'UserGroupsController@forceDeleteGroup'
    ]);


    Route::get('active-tasks', [
        'as'   => 'admin.manage.tasks',
        'uses' => 'TasksController@activeTasks'
    ]);

    Route::get('active-tasks/{tasks}', [
        'as'   => 'admin.task.show',
        'uses' => 'TasksController@showTask'
    ]);

    Route::delete('active-tasks/{tasks}', [
        'as'   => 'admin.task.soft.delete',
        'uses' => 'TasksController@softDelete'
    ]);

    Route::get('trashed-tasks', [
        'as'   => 'admin.trashed.tasks',
        'uses' => 'TasksController@trashedTasks'
    ]);

    Route::put('trashed-tasks/{tasks}', [
        'as'   => 'admin.restore.task',
        'uses' => 'TasksController@restoreTask'
    ]);

    Route::delete('trashed-tasks/{tasks}', [
        'as'   => 'admin.force.delete.task',
        'uses' => 'TasksController@forceDeleteTask'
    ]);


    Route::get('active-assignments', [
        'as'   => 'admin.assignments.all',
        'uses' => 'AssignmentsController@index'
    ]);

    Route::get('active-assignments/{assignments}', [
        'as'   => 'admin.assignments.show',
        'uses' => 'AssignmentsController@show'
    ]);

    Route::get('active-assignments/{assignments}/edit', [
        'as'   => 'admin.assignments.edit',
        'uses' => 'AssignmentsController@edit'
    ]);

    Route::patch('active-assignments/{assignments}', [
        'as'   => 'admin.assignments.update',
        'uses' => 'AssignmentsController@update'
    ]);

    Route::delete('active-assignments/{assignments}', [
        'as'   => 'admin.assignments.delete',
        'uses' => 'AssignmentsController@destroy'
    ]);

    Route::get('member/assignments/create', [
        'as'   => 'member.assignments',
        'uses' => 'AssignmentsController@createMemberAssignment'
    ]);

    Route::post('member/assignments', [
        'as'   => 'store.member.assignment',
        'uses' => 'AssignmentsController@storeMemberAssignment'
    ]);

    Route::get('group/assignments/create', [
        'as'   => 'group.assignments',
        'uses' => 'AssignmentsController@createGroupAssignment'
    ]);

    Route::post('group/assignments', [
        'as'   => 'store.group.assignment',
        'uses' => 'AssignmentsController@storeGroupAssignment'
    ]);

    Route::get('trashed-assignments', [
        'as'   => 'admin.trashed.assignments',
        'uses' => 'AssignmentsController@trashedAssignments'
    ]);

    Route::put('trashed-assignments/{assignments}', [
        'as'   => 'admin.assignments.restore',
        'uses' => 'AssignmentsController@restore'
    ]);

    Route::delete('trashed-assignments/{assignments}', [
        'as'   => 'admin.force.delete.assignment',
        'uses' => 'AssignmentsController@forceDeleteAssignment'
    ]);


    Route::get('notifications', [
        'as'   => 'admin.notifications.all',
        'uses' => 'NotificationsController@index'
    ]);

    Route::delete('notifications/{notifications}', [
        'as'   => 'admin.notifications.delete',
        'uses' => 'NotificationsController@destroy'
    ]);

    Route::get('member/notifications/create', [
        'as'   => 'member.notifications',
        'uses' => 'NotificationsController@createMemberNotification'
    ]);

    Route::post('member/notifications', [
        'as'   => 'store.member.notification',
        'uses' => 'NotificationsController@storeMemberNotification'
    ]);

    Route::get('group/notifications/create', [
        'as'   => 'group.notifications',
        'uses' => 'NotificationsController@createGroupNotification'
    ]);

    Route::post('group/notifications', [
        'as'   => 'store.group.notification',
        'uses' => 'NotificationsController@storeGroupNotification'
    ]);
});
