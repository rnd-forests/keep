<?php

foreach (File::allFiles(__DIR__ . '/Routes') as $file) {
    require_once $file->getPathname();
}

Route::post('queue/receive', function () {
    return Queue::marshal();
});