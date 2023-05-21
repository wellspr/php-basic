<?php

namespace Components\Posts;

use Databases\Posts;

class PostsComponents
{
    public $path;
    public $posts;

    function __construct($path)
    {
        $this->path = $path;
        $this->posts = new Posts;
    }

    function all_posts()
    {
        $results = $this->posts->fetch();

        foreach ($results as $row) {
            echo "<h3>Result " . $row['id'] . "</h3>";
            $post = new PostDisplay($row);
            $post->display_custom();
            $post->display_properties();
            echo "<hr>";
        }
    }

    function create_post()
    {
        $title = "";
        $headline = "";
        $body = "";

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $title = $_POST['title'];
            $headline = $_POST['headline'];
            $body = $_POST['body'];

            $this->posts->create_post($title, $headline, $body);
        }

        $form = new Form($title, $headline, $body);
        $form->render_form();
    }

    function post()
    {
        $results = $this->posts->get_post_by_id($this->path)[0];

        $title = "";
        $headline = "";
        $body = "";

        if (count($results) > 0) {
            $title = $results['title'];
            $headline = $results['headline'];
            $body = $results['body'];
        }

        $form = new Form($title, $headline, $body);
        $form->render_form();
    }
}


class PostDisplay
{
    public $post;

    function __construct($post)
    {
        $this->post = $post;
    }

    function display_custom()
    {
        $title = $this->post['title'];
        $created = $this->post['created'];

        echo "
            <h4>$title</h4>
            <p>$created</p>
        ";
    }

    function display_properties()
    {
        foreach ($this->post as $key => $value) {
            echo "<p>[$key]: $value </p>";
        }
    }
}


class Form
{

    public $title;
    public $headline;
    public $body;

    function __construct($title, $headline, $body)
    {
        $this->title = $title;
        $this->headline = $headline;
        $this->body = $body;
    }

    function render_form()
    {
        echo "
        <div class='create-post'>
            <form action='/posts/create-post' class='form' method='post'>
                <div class='form__input-group form__input-group--input'>
                    <label for='input-title' class='label'>Title</label>
                    <input id='input-title' type='text' name='title' class='form__input-title' value='";
        echo $this->title;
        echo "'>
                </div>
                <div class='form__input-group form__input-group--input'>
                    <label for='input-headline' class='label'>Headline</label>
                    <input id='input-headline' type='text' name='headline' class='form__input-headline' value='";
        echo $this->headline;
        echo "'>
                </div>
                <div class='form__input-group form__input-group--body'>
                    <label for='input-body' class='label'>Body</label>
                    <textarea id='input-body' name='body' class='form__input-body'>";
        echo $this->body;
        echo "</textarea>
                </div>
                <div class='form__controls'>
                    <button class='button'>Save</button>
                    <button class='button cancel'>Cancel</button>
                    <button class='button done'>Done</button>
                </div>
            </form>
        </div>
        ";
    }
}
