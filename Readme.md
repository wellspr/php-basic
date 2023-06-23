# PHP Router Project

This is an exercise on creating a php mini-framework based on a `Request-Response`, around the `MVC` model. This includes a routing system for the `controller` part and a template engine for the `view` part, keeping presentation separated from backend php logic. A model class based on the `PDO` class plays the `model` part.

The template engine used is [smarty](https://www.smarty.net/).

It is also possible to use [Vue](https://vuejs.org/guide/essentials/application.html) for templating. This way one can directly introduce interactivity and reactivity to the frontend interface.


## Example

```php
<?php

use Router\Router;

$app = new Router;

$app->register_route("get", "/", function($req, $res) {
    return $res->render(__DIR__."/templates/pages/home.tpl", array(
        "title" => "Home",
        "foo" => "bar"
    ));
});

$app->run();

?>
```

In the example above we instantiate a `Router` object as `$app` and use the method `register_route` to register new route. This method accepts three positional arguments. 
The first argument accepts a string representing the http method, the second parameter accepts a string representing the route's path, and the third parameter accepts a calback function. This callback funtion exposes two objects, named here `$req` and `$res`.

The `$req` object is populated with the `$_SERVER` parameters. Also, query strings can be obtained as an associative array from `$req['query]` and route parameters as `$req['id']`. 

The `$res` object has three methods: `render`, `send` and `json`. 


### Model

For example, create a user's table, following the user model as below:

```php
<?php

use Model\Model;

$user = new Model();

$user->init("users", array(
    "username" => "VARCHAR(30) NOT NULL UNIQUE",
    "email" => "VARCHAR(50)",
));

$user_1 = array(
    "username" => "user123",
    "email" => "user123@email.com"
);
$user->insert_data($user_1);

?>
```



## Local usage

At the root of the project run

    docker compose up --build -d