<?php

require_once __DIR__ . '/Routes/authentication.php';
require_once __DIR__ . '/Routes/pages.php';
require_once __DIR__ . '/Routes/users.php';
require_once __DIR__ . '/Routes/administrator.php';

Route::post('queue/receive', 'QueuesController@receive');