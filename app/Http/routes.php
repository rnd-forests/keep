<?php

foreach (File::allFiles(__DIR__ . '/Routes') as $file) {
    require $file->getPathname();
}

Route::group(['namespace' => 'Application'], function () {
    Route::post('queue/subscribe', 'QueuesController@subscribe');
});
