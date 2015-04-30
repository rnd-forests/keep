<?php

Route::get('{users}/tags', [
    'as' => 'users.tag.list',
    'uses' => 'TagsController@index'
]);

Route::get('{users}/tags/{tags}', [
    'as' => 'users.tag.tasks',
    'uses' => 'TagsController@show'
]);