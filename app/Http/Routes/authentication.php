<?php

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
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

    Route::patch('{users}/change-password', [
        'as'   => 'change.account.password',
        'uses' => 'AccountController@changePassword'
    ]);

    Route::patch('{users}/change-username', [
        'as'   => 'change.account.username',
        'uses' => 'AccountController@changeUsername'
    ]);

    Route::get('activate-account/{code}', [
        'as'   => 'account.activation',
        'uses' => 'RegistrationsController@activate'
    ]);

    Route::controllers(['password' => 'PasswordController']);
});

Route::group(['prefix' => 'oauth', 'namespace' => 'Auth'], function () {
    Route::get('github', [
        'as'   => 'github.authentication',
        'uses' => 'OAuthController@loginWithGithub'
    ]);

    Route::get('facebook', [
        'as'   => 'facebook.authentication',
        'uses' => 'OAuthController@loginWithFacebook'
    ]);
});