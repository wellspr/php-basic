<?php

/** Display erros in development mode */
require_once __DIR__."/logging.php";


/** Autoload classes */
//require_once __DIR__."/autoload.php";
require_once __DIR__."/../vendor/php-router/autoload.php";


/** Start Smarty template. 
 *  A smarty global variable is available from here.
 *  $GLOBAL['smarty]
 */
require_once __DIR__."/smarty.php";


function remove_trailing_slash()
{
    $uri = $_SERVER['REQUEST_URI'];

    $has_trailing_slash = $uri[-1] === "/" ? true : false;
    $is_root_route = $uri === "/";

    if (!$is_root_route && $has_trailing_slash) {
        header("Location: " . rtrim($uri, "/"));
        die();
    }
}

remove_trailing_slash();
