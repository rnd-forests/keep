<?php

Route::group(['prefix' => 'auth', 'as' => 'auth::', 'namespace' => 'Auth'], function () {
    Route::get('register', ['as' => 'register', 'uses' => 'AuthController@getRegister']);
    Route::post('register', ['as' => 'register', 'uses' => 'AuthController@postRegister']);
    Route::get('activate/{code}', ['as' => 'activate', 'uses' => 'AuthController@activate']);
    Route::get('login', ['as' => 'login', 'uses' => 'AuthController@getLogin']);
    Route::post('login', ['as' => 'login', 'uses' => 'AuthController@postLogin']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@getLogout']);

    Route::get('password/email', 'PasswordController@getEmail');
    Route::post('password/email', 'PasswordController@postEmail');
    Route::get('password/reset/{token}', 'PasswordController@getReset');
    Route::post('password/reset', ['as' => 'password.reset', 'uses' => 'PasswordController@postReset']);
});

Route::group(['prefix' => 'oauth', 'as' => 'oauth::', 'namespace' => 'Auth'], function () {
    Route::get('github', ['as' => 'github', 'uses' => 'OAuthController@authenticateWithGithub']);
    Route::get('facebook', ['as' => 'facebook', 'uses' => 'OAuthController@authenticateWithFacebook']);
    Route::get('google', ['as' => 'google', 'uses' => 'OAuthController@authenticateWithGoogle']);
});
