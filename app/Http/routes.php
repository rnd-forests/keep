<?php
//Event::listen('illuminate.query', function($sql)
//{
//    var_dump($sql);
//});
//
//Route::get('/console', function() {
//    Artisan::call('keep:email-upcoming-tasks');
//});

foreach (File::allFiles(__DIR__ . '/Routes') as $routePartial)
{
    require_once $routePartial->getPathname();
}
