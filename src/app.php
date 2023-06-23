<?php

use Router\Router;

$app = new Router;

include_once __DIR__."/models/user.php";

// Pages - Loaded from templates
$GLOBALS['pages_dir'] = __DIR__."/templates/pages";

$app->register_route("get", "/", function($req, $res) {    
    return $res->render($GLOBALS['pages_dir']."/home.tpl", array(
        "title" => "Home",
    ));
});

$app->register_route("get", "/about", function($req, $res) {
    return $res->render($GLOBALS['pages_dir']."/about.tpl", array(
        "title" => "About",
    ));
});

$app->register_route("get", "/posts", function($req, $res) {
    return $res->render($GLOBALS['pages_dir']."/posts.tpl", array(
        "title" => "Posts",
    ));
});

$app->register_route("post", "/posts", function($req, $res) {
    return $res->render($GLOBALS['pages_dir']."/posts.tpl", array(
        "title" => "Posts",
    ));
});


// API
$app->register_route("get", "/api", function($req, $res) {
    return $res->json(array("hello" => "there"), 200);
});

$app->register_route("get", "/api/:id", function($req, $res) {
    $id = $req['id'];
    if ($id === "test") {
        return $res->json(array("response" => $id));
    } else {
        $res->json(array("response" => "No such path '$id'"), 404);
    }
});


// RAW 
$app->register_route("get", "/data", function($req, $res) {
    return $res->send("<h1>Hello there!</h1>");
});

$app->register_route("get", "/data/:id", function($req, $res) {
    $data = $req['id'];
    return $res->send("<h1>Hello $data</h1>");
});

/*
$app->register_route("post", "/posts", function ($req) {
    (new Posts($req))->render();
});

$app->register_route("get", "/posts/:id", function ($req) {
    (new Posts($req))->render();
});

$app->register_route("get", "/posts/:id1/:id2", function ($req) {
    (new Posts($req))->render();
});

$app->register_route("get", "/posts/:id1/:id2/:id3", function ($req) {
    (new Posts($req))->render();
});

$app->register_route("get", "/a/b", function ($req) {
    echo "a/b";
});

$app->register_route("get", "/a/b/:id1/:id2", function ($req) {
    echo "a, b ->" . $req['id1'] . " ~ " . $req['id2']; 
});
*/

$app->run();
