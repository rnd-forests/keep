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


Route::get('{users}/dashboard', [
    'as'   => 'users.dashboard',
    'uses' => 'UserDashboardController@dashboard'
]);


Route::get('{users}/tasks/new', [
    'as'   => 'users.tasks.create',
    'uses' => 'UserTaskController@create'
]);

Route::post('{users}/tasks', [
    'as'   => 'users.tasks.store',
    'uses' => 'UserTaskController@store'
]);

Route::get('{users}/tasks/{tasks}', [
    'as'   => 'users.tasks.show',
    'uses' => 'UserTaskController@show'
]);

Route::get('{users}/tasks/{tasks}/edit', [
    'as'   => 'users.tasks.edit',
    'uses' => 'UserTaskController@edit'
]);

Route::match(['put', 'patch'], '{users}/tasks/{tasks}', [
    'as'   => 'users.tasks.update',
    'uses' => 'UserTaskController@update'
]);

Route::patch('{users}/tasks/{tasks}/complete', [
    'as'   => 'users.tasks.complete',
    'uses' => 'UserTaskController@complete'
]);

Route::delete('{users}/tasks/{tasks}', [
    'as'   => 'users.tasks.destroy',
    'uses' => 'UserTaskController@destroy'
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


Route::get('{users}/tags', [
    'as'   => 'users.tag.list',
    'uses' => 'TagsController@index'
]);

Route::get('{users}/tags/{tags}', [
    'as'   => 'users.tag.tasks',
    'uses' => 'TagsController@show'
]);


Route::get('{users}/priorities/{priorities}/tasks', [
    'as'   => 'users.priority.tasks',
    'uses' => 'PrioritiesController@show'
]);