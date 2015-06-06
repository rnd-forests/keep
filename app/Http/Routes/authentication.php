<?php

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::get('register', [
        'as'   => 'register',
        'uses' => 'AuthController@getRegister'
    ]);
    Route::post('register', [
        'as'   => 'register',
        'uses' => 'AuthController@postRegister'
    ]);

    Route::get('activate-account/{code}', [
        'as'   => 'account.activation',
        'uses' => 'AuthController@activate'
    ]);

    Route::get('login', [
        'as'   => 'login',
        'uses' => 'AuthController@getLogin'
    ]);
    Route::post('login', [
        'as'   => 'login',
        'uses' => 'AuthController@postLogin'
    ]);

    Route::get('logout', [
        'as'   => 'logout',
        'uses' => 'AuthController@logout'
    ]);

    Route::patch('{users}/change-password', [
        'as'   => 'change.account.password',
        'uses' => 'AccountController@changePassword'
    ]);

    Route::patch('{users}/change-username', [
        'as'   => 'change.account.username',
        'uses' => 'AccountController@changeUsername'
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

    Route::get('google', [
        'as'   => 'google.authentication',
        'uses' => 'OAuthController@loginWithGoogle'
    ]);
});