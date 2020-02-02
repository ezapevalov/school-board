<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('APP_ROOT', __DIR__);

// composer autoload
require_once "vendor/autoload.php";

// main app class
require_once "app.php";

try {
    $app = App::factory();
    $app->run();
} catch ( Exception $e ) {
    echo "<h1>" . $e->getMessage() . "</h1>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}