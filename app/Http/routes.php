<?php

foreach (File::allFiles(__DIR__ . '/Routes') as $file) {
    require_once $file->getPathname();
}
