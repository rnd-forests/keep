<?php

foreach (File::allFiles(__DIR__.'/Routes') as $file) {
    require $file->getPathname();
}

Route::group(['namespace' => 'App'], function () {
    Route::post('queue/subscribe', 'QueuesController@subscribe');
});
