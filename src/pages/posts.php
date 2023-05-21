<?php

use Components\Posts\PostsComponents;
use RouterClass\Router;

$router = new Router($_SERVER["REQUEST_URI"]);
$path = $router->path() ?? "all-posts";
$posts_components = new PostsComponents($path);

?>

<div class="posts">

    <div class="posts__header">
        <h2>Posts</h2>

        <ul class="posts__header__menu">
            <li><a href='/posts/all-posts'>All Posts</a></li>
            <li><a href='/posts/create-post'>Create Post</a></li>
        </ul>
    </div>

    <?php

    if ($path === "all-posts") 
    {
        $posts_components->all_posts();
    } 
    else if ($path === "create-post") 
    {
        $posts_components->create_post();
    } 
    else 
    {
        $posts_components->post();
    }

    ?>

</div>

<!--
/*
$sql_string = "CREATE TABLE Post (
id int(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
title varchar(255) NOT NULL,
headline varchar(255) NOT NULL,
body text(1000) NOT NULL,
created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

$posts->create_table($sql_string);
*/

/*
$posts->create_post(
    "My first post", 
    "This is the number one post", 
    "Finally a post in this database."  
);
*/