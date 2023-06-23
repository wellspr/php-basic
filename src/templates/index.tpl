{* Smarty *}

{{assign var="routes" value=[
    ["path" => "/", "name" => "Home"],
    ["path" => "/about", "name" => "About"],
    ["path" => "/posts", "name" => "Posts"]
]}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='/public/css/index.css'>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <title>{$title}</title>
</head>

<body>
    <div class="container app">
        <header class="app_header">
            <h1>Basic Router</h1>
            <nav class="app__header__menu nav">
                {foreach $routes as $route}
                    <a href={$route.path}>{$route.name}</a>
                {/foreach}
            </nav>
        </header>

        <main class="app__main">
            {include file="eval:{$template_main}"}
        </main>

        <footer class='app__footer'>
            <p class='footer__text'>
                &copy; 2023 - Basic php router | Powered by <a href="https://www.smarty.net/" target="_blank">Smarty</a>
            </p>
        </footer>
    </div>
    <script src="/public/js/index.js"></script>
</body>

</html>