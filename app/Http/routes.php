<?php

foreach (File::allFiles(__DIR__ . '/Routes') as $file) {
    require $file->getPathname();
}

Route::post('queue/subscribe', 'QueuesController@subscribe');
