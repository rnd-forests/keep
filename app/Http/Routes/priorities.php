<?php

Route::get('{users}/priorities/{priorities}/tasks', [
    'as'   => 'users.priority.tasks',
    'uses' => 'PrioritiesController@show'
]);