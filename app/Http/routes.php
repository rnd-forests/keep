<?php

// Administration routes
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
        'only' => ['index', 'destroy'],
        'names' => [
            'index' => 'members',
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
    Route::post('notifications', ['as' => 'notifications.store', 'uses' => 'NotificationsController@store']);
    Route::delete('notifications/{noti}', ['as' => 'notifications.delete', 'uses' => 'NotificationsController@destroy']);
    Route::get('notify/member', ['as' => 'notifications.member.create', 'uses' => 'NotificationsController@notifyMembers']);
    Route::get('notify/group', ['as' => 'notifications.group.create', 'uses' => 'NotificationsController@notifyGroups']);
});


// Authentication
Route::group(['prefix' => 'auth', 'as' => 'auth::', 'namespace' => 'Auth'], function () {
    Route::get('register', ['as' => 'register', 'uses' => 'AuthController@getRegister']);
    Route::post('register', ['as' => 'register', 'uses' => 'AuthController@postRegister']);
    Route::get('activate/{code}', ['as' => 'activate', 'uses' => 'AuthController@getActivate']);
    Route::get('login', ['as' => 'login', 'uses' => 'AuthController@getLogin']);
    Route::post('login', ['as' => 'login', 'uses' => 'AuthController@postLogin']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@getLogout']);

    Route::get('password/email', 'PasswordController@getEmail');
    Route::post('password/email', 'PasswordController@postEmail');
    Route::get('password/reset/{token}', 'PasswordController@getReset');
    Route::post('password/reset', 'PasswordController@postReset');
});

// Social (open) authentication
Route::group(['prefix' => 'oauth', 'as' => 'oauth::', 'namespace' => 'Auth'], function () {
    Route::get('github', ['as' => 'github', 'uses' => 'OAuthController@authenticateWithGithub']);
    Route::get('facebook', ['as' => 'facebook', 'uses' => 'OAuthController@authenticateWithFacebook']);
    Route::get('google', ['as' => 'google', 'uses' => 'OAuthController@authenticateWithGoogle']);
});


// API routes
Route::group(['namespace' => 'App'], function () {
    Route::post('queue/subscribe', 'QueuesController@subscribe');
});


// Common pages routes
Route::group(['namespace' => 'Pages'], function () {
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@home']);
});


// Member routes
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
    Route::post('tasks/sync', ['as' => 'tasks.sync', 'uses' => 'TasksController@syncFailedTasks']);
    Route::patch('tasks/{tasks}/complete', ['as' => 'tasks.complete', 'uses' => 'TasksController@complete']);
    Route::get('groups', ['as' => 'groups.all', 'uses' => 'GroupsController@index']);
    Route::get('groups/{groups}', ['as' => 'groups.show', 'uses' => 'GroupsController@show']);
    Route::get('tags/{tags}', ['as' => 'tags.task', 'uses' => 'TagsController@show']);
    Route::get('priorities/{priorities}', ['as' => 'priorities.task', 'uses' => 'PrioritiesController@show']);
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
