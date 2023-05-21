<?php

use RouterClass\Router;

$router = new Router($_SERVER["REQUEST_URI"]);
$path = $router->path();
    
if ($path) {
    echo "Hello $path!!!";
} else {
    echo "Hello!!!";
}
