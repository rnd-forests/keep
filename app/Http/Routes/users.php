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

Route::get('{users}/groups/{groups}', [
    'as'   => 'users.groups.show',
    'uses' => 'UserGroupController@show'
]);

Route::get('{users}/assignments', [
    'as'   => 'users.assignments.index',
    'uses' => 'UserAssignmentController@index'
]);

Route::get('{users}/personal-assignment/{assignments}', [
    'as'   => 'users.personal.assignments.show',
    'uses' => 'UserAssignmentController@showPersonalAssignment'
]);

Route::get('{users}/group-assignment/{assignments}', [
    'as'   => 'users.group.assignments.show',
    'uses' => 'UserAssignmentController@showGroupAssignment'
]);