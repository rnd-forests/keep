<?php

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function ()
{
    Route::get('register', [
        'as'   => 'register',
        'uses' => 'RegistrationsController@create'
    ]);

    Route::post('register', [
        'as'   => 'register',
        'uses' => 'RegistrationsController@store'
    ]);

    Route::get('login', [
        'as'   => 'login',
        'uses' => 'SessionsController@create'
    ]);

    Route::post('login', [
        'as'   => 'login',
        'uses' => 'SessionsController@store'
    ]);

    Route::get('logout', [
        'as'   => 'logout',
        'uses' => 'SessionsController@destroy'
    ]);

    Route::post('change-password', [
        'as'   => 'change.account.password',
        'uses' => 'AccountController@changePassword'
    ]);

    Route::get('activate-account/{code}', [
        'as'   => 'account.activation',
        'uses' => 'RegistrationsController@activate'
    ]);

    Route::controllers(['password' => 'PasswordController']);
});
