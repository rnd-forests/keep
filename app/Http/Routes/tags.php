<?php

Route::get('{users}/tags', [
    'as' => 'users.tag.list',
    'uses' => 'TagsController@index'
]);