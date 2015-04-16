<?php

Route::get('{users}/tasks', [
	'as' => 'users.tasks.index', 
	'uses' => 'UserTaskController@index'
]);

Route::get('{users}/tasks/new', [
	'as' => 'users.tasks.create', 
	'uses' => 'UserTaskController@create'
]);

Route::post('{users}/tasks', [
	'as' => 'users.tasks.store', 
	'uses' => 'UserTaskController@store'
]);

Route::get('{users}/tasks/{tasks}', [
	'as' => 'users.tasks.show', 
	'uses' => 'UserTaskController@show'
]);

Route::get('{users}/tasks/{tasks}/edit', [
	'as' => 'users.tasks.edit', 
	'uses' => 'UserTaskController@edit'
]);

Route::match(['put', 'patch'], '{users}/tasks/{tasks}', [
	'as' => 'users.tasks.update', 
	'uses' => 'UserTaskController@update'
]);

Route::patch('{users}/tasks/{tasks}/complete', [
	'as' => 'users.tasks.complete', 
	'uses' => 'UserTaskController@complete'
]);

Route::delete('{users}/tasks/{tasks}', [
	'as' => 'users.tasks.destroy', 
	'uses' => 'UserTaskController@destroy'
]);
