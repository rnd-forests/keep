<?php

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

Route::group(['middleware' => ['auth', 'auth.confirmed'], 'prefix' => 'admin', 'namespace' => 'Admin'], function() {
    Route::group(['middleware' => 'valid.roles', 'roles' => ['manage_users', 'manage_tasks']], function() {
        Route::get('dashboard', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@index']);
        Route::get('manage-members', ['as' => 'admin.manage.members', 'uses' => 'UsersController@members']);
    });
});

