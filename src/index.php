<?php

include "./router/Router.php";
include "./components/layout/Layout.php";
include "./components/posts/Posts.php";
include "./databases/Database.php";
include "./databases/Posts.php";

use Components\Layout\Footer;
use Components\Layout\Menu;
use RouterClass\Router;

$router = new Router($_SERVER["REQUEST_URI"]);
$menu = new Menu($router->pages());
$footer = new Footer;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="must-revalidate" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="/public/css/index.css">
    <title>
        <?php $router->page_title() ?>
    </title>
</head>

<body>
    <div class="container app">
        <header class="app__header">
            <h1 class="app__header__heading">
                <a href="/">PHP Projects Hub</a>
            </h1>
            <?php $menu->menu() ?>
        </header>
        <main class="app__main">
            <?php $router->routes() ?>
        </main>
        <footer class="app__footer">
            <p class="footer__text">
                <?php $footer->footer_text() ?>
            </p>
            <div>

            </div>
        </footer>
    </div>
</body>

</html>