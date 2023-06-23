<?php

use Model\Model;

$user = new Model();

$user->init("users", array(
    "username" => "VARCHAR(30) NOT NULL UNIQUE",
    "email" => "VARCHAR(50)",
));

//print_r($user->get_model());

/*
$user_1 = array(
    "username" => "user123",
    "email" => "user123@email.com"
);
$user->insert_data($user_1);
*/

//$users = $user->get_table_data();
//
//foreach($users as $user) {
//    print_r($user);
//    echo "<br>";
//};

//var_dump($user->get_table_data());
echo "<br>";
//print_r($user->get_row("*", "NOT username='user123'"));

//echo $user->update_row("email='abc123qwerty@email.com'", 7);

//echo $user->delete_row(7);
