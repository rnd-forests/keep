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

Route::get('{users}', ['as' => 'users.show', 'uses' => 'UsersController@show']);
Route::match(['put', 'patch'], '{users}', ['as' => 'users.update', 'uses' => 'UsersController@update']);
Route::delete('{users}', ['as' => 'users.destroy', 'uses' => 'UsersController@destroy']);

Route::get('{users}/tasks', ['as' => 'users.tasks.index', 'uses' => 'UserTaskController@index']);
Route::get('{users}/tasks/new', ['as' => 'users.tasks.create', 'uses' => 'UserTaskController@create']);
Route::post('{users}/tasks', ['as' => 'users.tasks.store', 'uses' => 'UserTaskController@store']);
Route::get('{users}/tasks/{tasks}', ['as' => 'users.tasks.show', 'uses' => 'UserTaskController@show']);
Route::get('{users}/tasks/{tasks}/edit', ['as' => 'users.tasks.edit', 'uses' => 'UserTaskController@edit']);
Route::match(['put', 'patch'], '{users}/tasks/{tasks}', ['as' => 'users.tasks.update', 'uses' => 'UserTaskController@update']);
Route::patch('{users}/tasks/{tasks}/complete', ['as' => 'users.tasks.complete', 'uses' => 'UserTaskController@complete']);
Route::delete('{users}/tasks/{tasks}', ['as' => 'users.tasks.destroy', 'uses' => 'UserTaskController@destroy']);

Route::group(['middleware' => ['auth', 'auth.confirmed', 'valid.admin.user'], 'prefix' => 'admin', 'namespace' => 'Admin'], function() {
    Route::get('dashboard', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@dashboard']);

    Route::get('active-members', ['as' => 'admin.active.accounts', 'uses' => 'UsersController@activeAccounts']);
    Route::get('active-members/{users}', ['as' => 'admin.active.account.profile', 'uses' => 'UsersController@profile']);
    Route::delete('active-members/{users}', ['as' => 'admin.active.account.disable', 'uses' => 'UsersController@disableAccount']);
    Route::get('disabled-members', ['as' => 'admin.disabled.accounts', 'uses' => 'UsersController@disabledAccounts']);
    Route::put('disabled-members/{users}', ['as' => 'admin.restore.account', 'uses' => 'UsersController@restoreAccount']);
    Route::delete('disabled-members/{users}', ['as' => 'admin.force.delete.account', 'uses' => 'UsersController@forceDeleteAccount']);

    Route::get('active-groups', ['as' => 'admin.active.groups', 'uses' => 'UserGroupsController@activeGroups']);
    Route::get('active-groups/create', ['as' => 'admin.groups.create', 'uses' => 'UserGroupsController@create']);
    Route::post('active-groups', ['as' => 'admin.groups.store', 'uses' => 'UserGroupsController@store']);
    Route::get('active-groups/{groups}', ['as' => 'admin.groups.show', 'uses' => 'UserGroupsController@show']);
    Route::get('active-groups/{groups}/add', ['as' => 'admin.groups.add.users', 'uses' => 'UserGroupsController@addUsers']);
    Route::post('active-groups/{groups}/add', ['as' => 'admin.groups.sync.users', 'uses' => 'UserGroupsController@storeNewUsers']);
    Route::post('active-groups/{groups}/{users}', ['as' => 'admin.groups.remove.user', 'uses' => 'UserGroupsController@removeUser']);
    Route::get('active-groups/{groups}/edit', ['as' => 'admin.groups.edit', 'uses' => 'UserGroupsController@edit']);
    Route::post('active-groups/{groups}', ['as' => 'admin.groups.flush', 'uses' => 'UserGroupsController@flush']);
    Route::patch('active-groups/{groups}', ['as' => 'admin.groups.update', 'uses' => 'UserGroupsController@update']);
    Route::delete('active-groups/{groups}', ['as' => 'admin.groups.delete', 'uses' => 'UserGroupsController@destroy']);
    Route::get('trashed-groups', ['as' => 'admin.trashed.groups', 'uses' => 'UserGroupsController@trashedGroups']);
    Route::put('trashed-groups/{groups}', ['as' => 'admin.groups.restore', 'uses' => 'UserGroupsController@restore']);
    Route::delete('trashed-groups/{groups}', ['as' => 'admin.force.delete.group', 'uses' => 'UserGroupsController@forceDeleteGroup']);

    Route::get('active-tasks', ['as' => 'admin.manage.tasks', 'uses' => 'TasksController@activeTasks']);
    Route::get('active-tasks/{tasks}', ['as' => 'admin.task.show', 'uses' => 'TasksController@showTask']);
    Route::delete('active-tasks/{tasks}', ['as' => 'admin.task.soft.delete', 'uses' => 'TasksController@softDelete']);
    Route::get('trashed-tasks', ['as' => 'admin.trashed.tasks', 'uses' => 'TasksController@trashedTasks']);
    Route::put('trashed-tasks/{tasks}', ['as' => 'admin.restore.task', 'uses' => 'TasksController@restoreTask']);
    Route::delete('trashed-tasks/{tasks}', ['as' => 'admin.force.delete.task', 'uses' => 'TasksController@forceDeleteTask']);
});

