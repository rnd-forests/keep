<?php

Route::get('{users}', [
    'as'   => 'users.show',
    'uses' => 'UsersController@show'
]);

Route::match(['put', 'patch'], '{users}', [
    'as'   => 'users.update',
    'uses' => 'UsersController@update'
]);

Route::delete('{users}', [
    'as'   => 'users.destroy',
    'uses' => 'UsersController@destroy'
]);

Route::get('{users}/groups', [
    'as'   => 'users.groups.index',
    'uses' => 'UserGroupController@index'
]);