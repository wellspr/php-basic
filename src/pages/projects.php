<?php

use RouterClass\Router;

$router = new Router($_SERVER["REQUEST_URI"]);
$path = $router->path();

?>

<div class="projects">

    <h2>Projects</h2>

    <ul>
        <li><a href='/projects/my-new-blog'>My new blog</a></li>
        <li><a href='/projects/portfolio-page'>Portfolio page</a></li>
        <li><a href='/projects/todo-list'>Todo list</a></li>
    </ul>

    <?php
    if ($path) {
        echo "<h3>Showing project:  $path.</h3>";
    }
    ?>

</div>