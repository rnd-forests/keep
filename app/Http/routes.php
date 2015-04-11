<?php
//Event::listen('illuminate.query', function($sql)
//{
//    var_dump($sql);
//});

Route::get('/', ['as' => 'home_path', 'uses' => 'HomeController@home']);

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function() {
    Route::get('register', ['as' => 'register_path', 'uses' => 'RegistrationsController@create']);
    Route::post('register', ['as' => 'register_path', 'uses' => 'RegistrationsController@store']);
    Route::get('login', ['as' => 'login_path', 'uses' => 'SessionsController@create']);
    Route::post('login', ['as' => 'login_path', 'uses' => 'SessionsController@store']);
    Route::get('logout', ['as' => 'logout_path', 'uses' => 'SessionsController@destroy']);
    Route::post('change-password', ['as' => 'change_account_password_path', 'uses' => 'AccountController@changePassword']);
    Route::get('activate-account/{code}', ['as' => 'account_activation_path', 'uses' => 'RegistrationsController@activate']);
    Route::controllers(['password' => 'PasswordController']);
});

Route::group(['middleware' => ['auth', 'auth.confirmed']], function() {
    Route::get('users/{users}', ['as' => 'users.show', 'uses' => 'UsersController@show']);
    Route::match(['put', 'patch'], 'users/{users}', ['as' => 'users.update', 'uses' => 'UsersController@update']);
    Route::delete('users/{users}', ['as' => 'users.destroy', 'uses' => 'UsersController@destroy']);
});

Route::resource('users.tasks', 'UserTaskController');

Route::group(['middleware' => ['auth', 'auth.confirmed', 'valid.admin.user'], 'prefix' => 'admin', 'namespace' => 'Admin'], function() {
    Route::get('dashboard', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@dashboard']);

    Route::get('accounts/active', ['as' => 'admin.active.accounts', 'uses' => 'UsersController@activeAccounts']);
    Route::get('accounts/active/{users}', ['as' => 'admin.active.account.profile', 'uses' => 'UsersController@profile']);
    Route::delete('accounts/active/{users}', ['as' => 'admin.active.account.disable', 'uses' => 'UsersController@disableAccount']);
    Route::get('accounts/disabled', ['as' => 'admin.disabled.accounts', 'uses' => 'UsersController@disabledAccounts']);
    Route::put('accounts/disabled/{users}', ['as' => 'admin.restore.account', 'uses' => 'UsersController@restoreAccount']);
    Route::delete('accounts/disabled/{users}', ['as' => 'admin.force.delete.account', 'uses' => 'UsersController@forceDeleteAccount']);

    Route::get('groups/active', ['as' => 'admin.active.groups', 'uses' => 'UserGroupsController@activeGroups']);
    Route::get('groups/active/create', ['as' => 'admin.groups.create', 'uses' => 'UserGroupsController@create']);
    Route::post('groups/active', ['as' => 'admin.groups.store', 'uses' => 'UserGroupsController@store']);
    Route::get('groups/active/{groups}', ['as' => 'admin.groups.show', 'uses' => 'UserGroupsController@show']);
    Route::get('groups/active/{groups}/add', ['as' => 'admin.groups.add.users', 'uses' => 'UserGroupsController@addUsers']);
    Route::post('groups/active/{groups}/{users}', ['as' => 'admin.groups.remove.user', 'uses' => 'UserGroupsController@removeUser']);
    Route::get('groups/active/{groups}/edit', ['as' => 'admin.groups.edit', 'uses' => 'UserGroupsController@edit']);
    Route::post('groups/active/{groups}', ['as' => 'admin.groups.flush', 'uses' => 'UserGroupsController@flush']);
    Route::patch('groups/active/{groups}', ['as' => 'admin.groups.update', 'uses' => 'UserGroupsController@update']);
    Route::delete('groups/active/{groups}', ['as' => 'admin.groups.delete', 'uses' => 'UserGroupsController@destroy']);
    Route::get('groups/trashed', ['as' => 'admin.trashed.groups', 'uses' => 'UserGroupsController@trashedGroups']);
    Route::put('groups/trashed/{groups}', ['as' => 'admin.groups.restore', 'uses' => 'UserGroupsController@restore']);
    Route::delete('groups/trashed/{groups}', ['as' => 'admin.force.delete.group', 'uses' => 'UserGroupsController@forceDeleteGroup']);

    Route::get('tasks/active', ['as' => 'admin.manage.tasks', 'uses' => 'TasksController@activeTasks']);
    Route::get('tasks/active/{tasks}', ['as' => 'admin.task.show', 'uses' => 'TasksController@showTask']);
    Route::delete('tasks/active/{tasks}', ['as' => 'admin.task.soft.delete', 'uses' => 'TasksController@softDelete']);
    Route::get('tasks/trashed', ['as' => 'admin.trashed.tasks', 'uses' => 'TasksController@trashedTasks']);
    Route::put('tasks/trashed/{tasks}', ['as' => 'admin.restore.task', 'uses' => 'TasksController@restoreTask']);
    Route::delete('tasks/trashed/{tasks}', ['as' => 'admin.force.delete.task', 'uses' => 'TasksController@forceDeleteTask']);
});

