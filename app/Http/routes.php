<?php
//Event::listen('illuminate.query', function($sql)
//{
//    var_dump($sql);
//});

foreach(File::allFiles(__DIR__ . '/Routes') as $routePartial)
{
    require_once $routePartial->getPathname();
}
